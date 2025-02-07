<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Core\Security;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Trait providing support for JWT using symmetric hash signing.
 *
 * The benefit of using a trait in this particular case is, that defaults in `self::class`
 * (used as a pepper during the singing process) are specific for that a particular implementation.
 *
 * @internal
 */
trait JwtTrait
{
    private static function getDefaultSigningAlgorithm(): string
    {
        return 'HS256';
    }

    private static function createSigningKeyFromEncryptionKey(string $pepper = self::class): Key
    {
        if ($pepper === '') {
            $pepper = self::class;
        }
        $encryptionKey = $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] ?? '';
        $keyMaterial = hash('sha256', $encryptionKey) . '/' . $pepper;
        return new Key($keyMaterial, self::getDefaultSigningAlgorithm());
    }

    private static function createSigningSecret(SigningSecretInterface $secret, string $pepper = self::class): Key
    {
        if ($pepper === '') {
            $pepper = self::class;
        }
        $keyMaterial = $secret->getSigningSecret() . '/' . $pepper;
        return new Key($keyMaterial, self::getDefaultSigningAlgorithm());
    }

    private static function encodeHashSignedJwt(array $payload, Key $key, SecretIdentifier $identifier = null): string
    {
        // @todo work-around until https://github.com/firebase/php-jwt/pull/446/files is merged
        $errorLevel = self::ignoreJwtPhp82Deprecations();

        $keyId = $identifier !== null ? json_encode($identifier) : null;
        try {
            $jwt = JWT::encode($payload, $key->getKeyMaterial(), self::getDefaultSigningAlgorithm(), $keyId);
        } catch(\Exception $e) {
            throw $e;
        } finally {
            if (is_int($errorLevel)) {
                error_reporting($errorLevel);
            }
        }

        return $jwt;
    }

    private static function decodeJwt(string $jwt, Key $key, bool $associative = false): \stdClass|array
    {
        // @todo work-around until https://github.com/firebase/php-jwt/pull/446/files is merged
        $errorLevel = self::ignoreJwtPhp82Deprecations();

        try {
            $payload = JWT::decode($jwt, $key);
        } catch(\Exception $e) {
            throw $e;
        } finally {
            if (is_int($errorLevel)) {
                error_reporting($errorLevel);
            }
        }

        return $associative ? json_decode(json_encode($payload), true) : $payload;
    }

    private static function decodeJwtHeader(string $jwt, string $property): mixed
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return null;
        }
        $headerRaw = JWT::urlsafeB64Decode($parts[0]);
        if (($header = JWT::jsonDecode($headerRaw)) === null) {
            return null;
        }
        return $header->{$property} ?? null;
    }

    private static function ignoreJwtPhp82Deprecations(): ?int
    {
        $php82 = version_compare(PHP_VERSION, '8.1.999', '>');
        if (!$php82) {
            return null;
        }
        $errorLevel = error_reporting();
        return error_reporting($errorLevel ^ E_DEPRECATED);
    }
}
