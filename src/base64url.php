<?php


namespace Ieu\Base64Url\Internal;


const PADDING_CHAR = '=';

const BASE64_TABLE = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_";

const BASE64_REVERSE_TABLE = [
    "\x0" => -2, "\x1" => -2, "\x2" => -2, "\x3" => -2,
    "\x4" => -2, "\x5" => -2, "\x6" => -2, "\x7" => -2,
    "\x8" => -2, "\t" => -2, "\n" => -2, "\v" => -2,
    "\f" => -2, "\r" => -2, "\xE" => -2, "\xF" => -2,
    "\x10" => -2, "\x11" => -2, "\x12" => -2, "\x13" => -2,
    "\x14" => -2, "\x15" => -2, "\x16" => -2, "\x17" => -2,
    "\x18" => -2, "\x19" => -2, "\x1A" => -2, "\e" => -2,
    "\x1C" => -2, "\x1D" => -2, "\x1E" => -2, "\x1F" => -2,
    "\x20" => -2, "!" => -2, "\"" => -2, "#" => -2,
    "$" => -2, "%" => -2, "&" => -2, "'" => -2,
    "(" => -2, ")" => -2, "*" => -2, "+" => -2,
    "," => -2, "-" => 62, "." => -2, "/" => -2,
    "0" => 52, "1" => 53, "2" => 54, "3" => 55,
    "4" => 56, "5" => 57, "6" => 58, "7" => 59,
    "8" => 60, "9" => 61, ":" => -2, ";" => -2,
    "<" => -2, "=" => -2, ">" => -2, "?" => -2,
    "@" => -2, "A" => 0, "B" => 1, "C" => 2,
    "D" => 3, "E" => 4, "F" => 5, "G" => 6,
    "H" => 7, "I" => 8, "J" => 9, "K" => 10,
    "L" => 11, "M" => 12, "N" => 13, "O" => 14,
    "P" => 15, "Q" => 16, "R" => 17, "S" => 18,
    "T" => 19, "U" => 20, "V" => 21, "W" => 22,
    "X" => 23, "Y" => 24, "Z" => 25, "[" => -2,
    "\\" => -2, "]" => -2, "^" => -2, "_" => 63,
    "`" => -2, "a" => 26, "b" => 27, "c" => 28,
    "d" => 29, "e" => 30, "f" => 31, "g" => 32,
    "h" => 33, "i" => 34, "j" => 35, "k" => 36,
    "l" => 37, "m" => 38, "n" => 39, "o" => 40,
    "p" => 41, "q" => 42, "r" => 43, "s" => 44,
    "t" => 45, "u" => 46, "v" => 47, "w" => 48,
    "x" => 49, "y" => 50, "z" => 51, "{" => -2,
    "|" => -2, "}" => -2, "~" => -2, "\x7F" => -2,
    "\x80" => -2, "\x81" => -2, "\x82" => -2, "\x83" => -2,
    "\x84" => -2, "\x85" => -2, "\x86" => -2, "\x87" => -2,
    "\x88" => -2, "\x89" => -2, "\x8A" => -2, "\x8B" => -2,
    "\x8C" => -2, "\x8D" => -2, "\x8E" => -2, "\x8F" => -2,
    "\x90" => -2, "\x91" => -2, "\x92" => -2, "\x93" => -2,
    "\x94" => -2, "\x95" => -2, "\x96" => -2, "\x97" => -2,
    "\x98" => -2, "\x99" => -2, "\x9A" => -2, "\x9B" => -2,
    "\x9C" => -2, "\x9D" => -2, "\x9E" => -2, "\x9F" => -2,
    "\xA0" => -2, "\xA1" => -2, "\xA2" => -2, "\xA3" => -2,
    "\xA4" => -2, "\xA5" => -2, "\xA6" => -2, "\xA7" => -2,
    "\xA8" => -2, "\xA9" => -2, "\xAA" => -2, "\xAB" => -2,
    "\xAC" => -2, "\xAD" => -2, "\xAE" => -2, "\xAF" => -2,
    "\xB0" => -2, "\xB1" => -2, "\xB2" => -2, "\xB3" => -2,
    "\xB4" => -2, "\xB5" => -2, "\xB6" => -2, "\xB7" => -2,
    "\xB8" => -2, "\xB9" => -2, "\xBA" => -2, "\xBB" => -2,
    "\xBC" => -2, "\xBD" => -2, "\xBE" => -2, "\xBF" => -2,
    "\xC0" => -2, "\xC1" => -2, "\xC2" => -2, "\xC3" => -2,
    "\xC4" => -2, "\xC5" => -2, "\xC6" => -2, "\xC7" => -2,
    "\xC8" => -2, "\xC9" => -2, "\xCA" => -2, "\xCB" => -2,
    "\xCC" => -2, "\xCD" => -2, "\xCE" => -2, "\xCF" => -2,
    "\xD0" => -2, "\xD1" => -2, "\xD2" => -2, "\xD3" => -2,
    "\xD4" => -2, "\xD5" => -2, "\xD6" => -2, "\xD7" => -2,
    "\xD8" => -2, "\xD9" => -2, "\xDA" => -2, "\xDB" => -2,
    "\xDC" => -2, "\xDD" => -2, "\xDE" => -2, "\xDF" => -2,
    "\xE0" => -2, "\xE1" => -2, "\xE2" => -2, "\xE3" => -2,
    "\xE4" => -2, "\xE5" => -2, "\xE6" => -2, "\xE7" => -2,
    "\xE8" => -2, "\xE9" => -2, "\xEA" => -2, "\xEB" => -2,
    "\xEC" => -2, "\xED" => -2, "\xEE" => -2, "\xEF" => -2,
    "\xF0" => -2, "\xF1" => -2, "\xF2" => -2, "\xF3" => -2,
    "\xF4" => -2, "\xF5" => -2, "\xF6" => -2, "\xF7" => -2,
    "\xF8" => -2, "\xF9" => -2, "\xFA" => -2, "\xFB" => -2,
    "\xFC" => -2, "\xFD" => -2, "\xFE" => -2, "\xFF" => -2
];

const ASCII_TABLE = "\x0\x1\x2\x3\x4\x5\x6\x7\x8\t\n\v\f\r\xE\xF\x10\x11\x12\x13\x14\x15\x16\x17\x18\x19\x1A\e\x1C\x1D\x1E\x1F\x20!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~\x7F\x80\x81\x82\x83\x84\x85\x86\x87\x88\x89\x8A\x8B\x8C\x8D\x8E\x8F\x90\x91\x92\x93\x94\x95\x96\x97\x98\x99\x9A\x9B\x9C\x9D\x9E\x9F\xA0\xA1\xA2\xA3\xA4\xA5\xA6\xA7\xA8\xA9\xAA\xAB\xAC\xAD\xAE\xAF\xB0\xB1\xB2\xB3\xB4\xB5\xB6\xB7\xB8\xB9\xBA\xBB\xBC\xBD\xBE\xBF\xC0\xC1\xC2\xC3\xC4\xC5\xC6\xC7\xC8\xC9\xCA\xCB\xCC\xCD\xCE\xCF\xD0\xD1\xD2\xD3\xD4\xD5\xD6\xD7\xD8\xD9\xDA\xDB\xDC\xDD\xDE\xDF\xE0\xE1\xE2\xE3\xE4\xE5\xE6\xE7\xE8\xE9\xEA\xEB\xEC\xED\xEE\xEF\xF0\xF1\xF2\xF3\xF4\xF5\xF6\xF7\xF8\xF9\xFA\xFB\xFC\xFD\xFE\xFF";

const ASCII_REVERSE_TABLE = [
    "\x0" => 0, "\x1" => 1, "\x2" => 2, "\x3" => 3,
    "\x4" => 4, "\x5" => 5, "\x6" => 6, "\x7" => 7,
    "\x8" => 8, "\t" => 9, "\n" => 10, "\v" => 11,
    "\f" => 12, "\r" => 13, "\xE" => 14, "\xF" => 15,
    "\x10" => 16, "\x11" => 17, "\x12" => 18, "\x13" => 19,
    "\x14" => 20, "\x15" => 21, "\x16" => 22, "\x17" => 23,
    "\x18" => 24, "\x19" => 25, "\x1A" => 26, "\e" => 27,
    "\x1C" => 28, "\x1D" => 29, "\x1E" => 30, "\x1F" => 31,
    "\x20" => 32, "!" => 33, "\"" => 34, "#" => 35,
    "$" => 36, "%" => 37, "&" => 38, "'" => 39,
    "(" => 40, ")" => 41, "*" => 42, "+" => 43,
    "," => 44, "-" => 45, "." => 46, "/" => 47,
    "0" => 48, "1" => 49, "2" => 50, "3" => 51,
    "4" => 52, "5" => 53, "6" => 54, "7" => 55,
    "8" => 56, "9" => 57, ":" => 58, ";" => 59,
    "<" => 60, "=" => 61, ">" => 62, "?" => 63,
    "@" => 64, "A" => 65, "B" => 66, "C" => 67,
    "D" => 68, "E" => 69, "F" => 70, "G" => 71,
    "H" => 72, "I" => 73, "J" => 74, "K" => 75,
    "L" => 76, "M" => 77, "N" => 78, "O" => 79,
    "P" => 80, "Q" => 81, "R" => 82, "S" => 83,
    "T" => 84, "U" => 85, "V" => 86, "W" => 87,
    "X" => 88, "Y" => 89, "Z" => 90, "[" => 91,
    "\\" => 92, "]" => 93, "^" => 94, "_" => 95,
    "`" => 96, "a" => 97, "b" => 98, "c" => 99,
    "d" => 100, "e" => 101, "f" => 102, "g" => 103,
    "h" => 104, "i" => 105, "j" => 106, "k" => 107,
    "l" => 108, "m" => 109, "n" => 110, "o" => 111,
    "p" => 112, "q" => 113, "r" => 114, "s" => 115,
    "t" => 116, "u" => 117, "v" => 118, "w" => 119,
    "x" => 120, "y" => 121, "z" => 122, "{" => 123,
    "|" => 124, "}" => 125, "~" => 126, "\x7F" => 127,
    "\x80" => 128, "\x81" => 129, "\x82" => 130, "\x83" => 131,
    "\x84" => 132, "\x85" => 133, "\x86" => 134, "\x87" => 135,
    "\x88" => 136, "\x89" => 137, "\x8A" => 138, "\x8B" => 139,
    "\x8C" => 140, "\x8D" => 141, "\x8E" => 142, "\x8F" => 143,
    "\x90" => 144, "\x91" => 145, "\x92" => 146, "\x93" => 147,
    "\x94" => 148, "\x95" => 149, "\x96" => 150, "\x97" => 151,
    "\x98" => 152, "\x99" => 153, "\x9A" => 154, "\x9B" => 155,
    "\x9C" => 156, "\x9D" => 157, "\x9E" => 158, "\x9F" => 159,
    "\xA0" => 160, "\xA1" => 161, "\xA2" => 162, "\xA3" => 163,
    "\xA4" => 164, "\xA5" => 165, "\xA6" => 166, "\xA7" => 167,
    "\xA8" => 168, "\xA9" => 169, "\xAA" => 170, "\xAB" => 171,
    "\xAC" => 172, "\xAD" => 173, "\xAE" => 174, "\xAF" => 175,
    "\xB0" => 176, "\xB1" => 177, "\xB2" => 178, "\xB3" => 179,
    "\xB4" => 180, "\xB5" => 181, "\xB6" => 182, "\xB7" => 183,
    "\xB8" => 184, "\xB9" => 185, "\xBA" => 186, "\xBB" => 187,
    "\xBC" => 188, "\xBD" => 189, "\xBE" => 190, "\xBF" => 191,
    "\xC0" => 192, "\xC1" => 193, "\xC2" => 194, "\xC3" => 195,
    "\xC4" => 196, "\xC5" => 197, "\xC6" => 198, "\xC7" => 199,
    "\xC8" => 200, "\xC9" => 201, "\xCA" => 202, "\xCB" => 203,
    "\xCC" => 204, "\xCD" => 205, "\xCE" => 206, "\xCF" => 207,
    "\xD0" => 208, "\xD1" => 209, "\xD2" => 210, "\xD3" => 211,
    "\xD4" => 212, "\xD5" => 213, "\xD6" => 214, "\xD7" => 215,
    "\xD8" => 216, "\xD9" => 217, "\xDA" => 218, "\xDB" => 219,
    "\xDC" => 220, "\xDD" => 221, "\xDE" => 222, "\xDF" => 223,
    "\xE0" => 224, "\xE1" => 225, "\xE2" => 226, "\xE3" => 227,
    "\xE4" => 228, "\xE5" => 229, "\xE6" => 230, "\xE7" => 231,
    "\xE8" => 232, "\xE9" => 233, "\xEA" => 234, "\xEB" => 235,
    "\xEC" => 236, "\xED" => 237, "\xEE" => 238, "\xEF" => 239,
    "\xF0" => 240, "\xF1" => 241, "\xF2" => 242, "\xF3" => 243,
    "\xF4" => 244, "\xF5" => 245, "\xF6" => 246, "\xF7" => 247,
    "\xF8" => 248, "\xF9" => 249, "\xFA" => 250, "\xFB" => 251,
    "\xFC" => 252, "\xFD" => 253, "\xFE" => 254, "\xFF" => 255
];


namespace Ieu\Base64Url;


use const Ieu\Base64Url\Internal\PADDING_CHAR;
use const Ieu\Base64Url\Internal\BASE64_TABLE;
use const Ieu\Base64Url\Internal\BASE64_REVERSE_TABLE;
use const Ieu\Base64Url\Internal\ASCII_TABLE;
use const Ieu\Base64Url\Internal\ASCII_REVERSE_TABLE;

/**
 * Encoding data into base64url
 *
 * @param string $data
 * @param boolean $padding
 * @return string
 */
function base64url_encode($data, $padding = true)
{
    $encoded = '';

    for ($offset = 0, $remaining = strlen($data); $remaining > 2; $remaining -= 3) {
        $b1 = ASCII_REVERSE_TABLE[$data[$offset++]];
        $b2 = ASCII_REVERSE_TABLE[$data[$offset++]];
        $b3 = ASCII_REVERSE_TABLE[$data[$offset++]];
        $encoded .= BASE64_TABLE[($b1 >> 2) & 0x3F];
        $encoded .= BASE64_TABLE[(($b1 << 4) | ($b2 >> 4)) & 0x3F];
        $encoded .= BASE64_TABLE[(($b2 << 2) | ($b3 >> 6)) & 0x3F];
        $encoded .= BASE64_TABLE[$b3 & 0x3F];
    }

    if (1 == $remaining) {
        $b1 = ASCII_REVERSE_TABLE[$data[$offset++]];
        $encoded .= BASE64_TABLE[($b1 >> 2) & 0x3F];
        $encoded .= BASE64_TABLE[($b1 << 4) & 0x3F];
        if ($padding) {
            $encoded .= PADDING_CHAR;
            $encoded .= PADDING_CHAR;
        }
    } elseif (2 == $remaining) {
        $b1 = ASCII_REVERSE_TABLE[$data[$offset++]];
        $b2 = ASCII_REVERSE_TABLE[$data[$offset++]];
        $encoded .= BASE64_TABLE[($b1 >> 2) & 0x3F];
        $encoded .= BASE64_TABLE[(($b1 << 4) | ($b2 >> 4)) & 0x3F];
        $encoded .= BASE64_TABLE[($b2 << 2) & 0x3F];
        if ($padding) {
            $encoded .= PADDING_CHAR;
        }
    }

    return $encoded;
}

/**
 * Decode base64url back to data
 *
 * Return false on error detected
 *
 * @param $data
 * @param $strict
 * @return false|string
 */
function base64url_decode($data, $strict = false)
{
    $decoded = '';

    for (
        $i = 0,
        $j = 0,
        $padding = 0,
        $l = strlen($data);
        $i < $l;
        ++$i
    ) {
        $char = $data[$i];

        if (PADDING_CHAR === $char) {
            ++$padding;
            continue;
        }

        $code = BASE64_REVERSE_TABLE[$char];

        if (-2 === $code) {
            if ($strict) {
                return false;
            } else {
                continue;
            }
        } else if ($padding) {
            return false;
        }

        switch ($j++ % 4) {
            case 0:
                $highBits = $code << 2;
                break;
            case 1:
                $decoded .= ASCII_TABLE[$highBits | $code >> 4];
                $highBits = $code << 4 & 0xFF;
                break;
            case 2:
                $decoded .= ASCII_TABLE[$highBits | $code >> 2];
                $highBits = $code << 6 & 0xFF;
                break;
            case 3:
                $decoded .= ASCII_TABLE[$highBits | $code];
                break;
        }
    }

    return $decoded;
}
