<?php

use Itau\Service\Client;

it('remove apenas valores null, mantendo 0, string vazia e false', function () {
    expect(Client::arrayRemoveNull(['a' => 0, 'b' => '', 'c' => false, 'd' => null]))
        ->toBe(['a' => 0, 'b' => '', 'c' => false]);
});

it('reindexa chaves numéricas e preserva chaves texto', function () {
    expect(Client::arrayRemoveNull([3 => 'x', 7 => null, 'k' => 'v', 9 => 'y']))
        ->toBe([0 => 'x', 'k' => 'v', 1 => 'y']);
});

it('remove null de forma recursiva', function () {
    $data = ['dado' => ['lista' => [['m' => 'x', 'n' => null], null, ['m' => null]], 'z' => null]];

    expect(Client::arrayRemoveNull($data))
        ->toBe(['dado' => ['lista' => [['m' => 'x'], []]]]);
});

it('retorna o valor sem alteração quando não é array', function () {
    expect(Client::arrayRemoveNull('texto'))->toBe('texto');
});
