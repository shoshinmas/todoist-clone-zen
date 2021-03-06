<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CsvService
{
    public function fileEncode($data, $filename): Response
    {
        $response = new Response((new Serializer([new ObjectNormalizer()], [new CsvEncoder()]))->encode($data, CsvEncoder::FORMAT));
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', "attachment; filename=\"$filename\"");
        return $response;
    }

    public function fileDecode($filename, $options = [])
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        if ($filename) {
            return $serializer->decode(file_get_contents($filename), CsvEncoder::FORMAT, $options);
        }
        else {
            echo "Wrong filename or file doesn't exist";
            return null;
        }
    }

}