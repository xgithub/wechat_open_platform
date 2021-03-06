<?php
/*
 * This file is part of the takatost/wechat_open_platform.
 *
 * (c) takatost <takatost@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WechatOP\Core;

use ArrayAccess;
use InvalidArgumentException;
use JsonSerializable;
use Overtrue\Socialite\AccessTokenInterface;
use Overtrue\Socialite\AttributeTrait;

class AuthAccessToken implements AccessTokenInterface, ArrayAccess, JsonSerializable
{
    use AttributeTrait;

    /**
     * AccessToken constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (empty($attributes['authorizer_access_token'])) {
            throw new InvalidArgumentException('The key "authorizer_access_token" could not be empty.');
        }

        $this->attributes = $attributes;
    }

    /**
     * Return the access token string.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getAttribute('authorizer_access_token');
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return strval($this->getAttribute('authorizer_access_token', ''));
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->getToken();
    }
}