<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $config = array(
            "digest_alg" => "md5",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );
        // Create the private and public key
        $res = openssl_pkey_new($config);

        // Extract the private key from $res to $privKey
        openssl_pkey_export($res, $privKey);

        // Extract the public key from $res to $pubKey
        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey["key"];

        $hash = hash('md5','Dao Manh Quan');
        openssl_private_encrypt($hash, $encrypted, $privKey);

        openssl_public_decrypt($encrypted, $decript, $pubKey);
        $data = hash('md5','Dao Manh Quan');
        return $decript;
    }
}
