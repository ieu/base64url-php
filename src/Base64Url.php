<?php


namespace Ieu\Base64Url;


class Base64Url
{
    private function __construct()
    {
    }

    /**
     * Encoding data into base64url
     *
     * @param string $data
     * @param boolean $padding
     * @return string
     */
    public static function encode($data, $padding = true)
    {
        $encoded = [];

        $data = unpack('C*', $data);

        $dataLength = count($data) + 1;
        for($offset = 1; $offset + 3 <= $dataLength; $offset += 3) {
            $b1 = $data[$offset];
            $b2 = $data[$offset + 1];
            $b3 = $data[$offset + 2];
            $encoded[] = self::b2a(($b1 >> 2) & 0x3F);
            $encoded[] = self::b2a((($b1 << 4) | ($b2 >> 4)) & 0x3F);
            $encoded[] = self::b2a((($b2 << 2) | ($b3 >> 6)) & 0x3F);
            $encoded[] = self::b2a($b3 & 0x3F);
        }

        if ($offset + 1 == $dataLength) {
            $b1 = $data[$offset];
            $encoded[] = self::b2a(($b1 >> 2) & 0x3F);
            $encoded[] = self::b2a(($b1 << 4) & 0x3F);
            if ($padding) {
                $encoded[] = 0x3D;
                $encoded[] = 0x3D;
            }
        } elseif ($offset + 2 == $dataLength) {
            $b1 = $data[$offset];
            $b2 = $data[$offset + 1];
            $encoded[] = self::b2a(($b1 >> 2) & 0x3F);
            $encoded[] = self::b2a((($b1 << 4) | ($b2 >> 4)) & 0x3F);
            $encoded[] = self::b2a(($b2 << 2) & 0x3F);
            if ($padding) {
                $encoded[] = 0x3D;
            }
        }

        return pack('C*', ...$encoded);
    }

    /**
     * Decode base64url back to data
     *
     * Return false on error detected
     *
     * @param $data
     * @return false|string
     */
    public static function decode($data)
    {
        $decoded = [];
        $data = unpack('C*', rtrim($data, '='));

        $err = 0;

        $dataLength = count($data) + 1;
        for ($offset = 1; $offset + 4 <= $dataLength; $offset += 4) {
            $c1 = self::a2b($data[$offset]);
            $c2 = self::a2b($data[$offset + 1]);
            $c3 = self::a2b($data[$offset + 2]);
            $c4 = self::a2b($data[$offset + 3]);

            $decoded[] = (($c1 << 2) | ($c2 >> 4)) & 0xFF;
            $decoded[] = (($c2 << 4) | ($c3 >> 2)) & 0xFF;
            $decoded[] = (($c3 << 6) | $c4) & 0xFF;

            $err |= ($c1 | $c2 | $c3 | $c4) >> 8;
        }

        if ($offset + 1 == $dataLength) {
            $c1 = self::a2b($data[$offset]);

            $decoded[] = ($c1 << 2) && 0xFF;

            $err |= $c1 >> 8;
        } elseif ($offset + 2 == $dataLength) {
            $c1 = self::a2b($data[$offset]);
            $c2 = self::a2b($data[$offset + 1]);

            $decoded[] = (($c1 << 2) | ($c2 >> 4)) & 0xFF;

            $err |= ($c1 | $c2) >> 8;
        } elseif ($offset + 3 == $dataLength) {
            $c1 = self::a2b($data[$offset]);
            $c2 = self::a2b($data[$offset + 1]);
            $c3 = self::a2b($data[$offset + 2]);

            $decoded[] = (($c1 << 2) | ($c2 >> 4)) & 0xFF;
            $decoded[] = (($c2 << 4) | ($c3 >> 2)) & 0xFF;

            $err |= ($c1 | $c2 | $c3) >> 8;
        }

        if ($err) {
            return false;
        } else {
            return pack('C*', ...$decoded);
        }
    }

    /**
     * Convert Base64 value to ASCII value
     *
     * @param int $val
     * @return int
     */
    protected static function b2a($val)
    {
        return $val
            + 0x41
            + (((25 - $val) >> 8) & 6)
            - (((51 - $val) >> 8) & 75)
            - (((61 - $val) >> 8) & 13)
            + (((62 - $val) >> 8) & 49);
    }

    /**
     * Convert ASCII value to Base64 value
     *
     * Base64 character set:
     * [A-Z]      [a-z]      [0-9]      -     _
     * 0x41-0x5A, 0x61-0x7A, 0x30-0x39, 0x5F, 0x2D
     *
     * @param int $ch
     * @return int
     */
    protected static function a2b($ch)
    {
        return -1
            + ((((0x40 - $ch) & ($ch - 0x5B)) >> 8) & ($ch - 64))
            + ((((0x60 - $ch) & ($ch - 0x7B)) >> 8) & ($ch - 70))
            + ((((0x2F - $ch) & ($ch - 0x3A)) >> 8) & ($ch + 5))
            + ((((0x2C - $ch) & ($ch - 0x2E)) >> 8) & 63)
            + ((((0x5E - $ch) & ($ch - 0x60)) >> 8) & 64);
    }
}
