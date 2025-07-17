<?php

namespace App\Controller;

use App\Model\Usuario;

use Hyperf\HttpServer\Annotation\Controller;


class ValidacoesController extends AbstractController {

    public function cpf(String $cpf) {

        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex: 111.111.111-11), que torna o CPF inválido
        if (preg_match('/(\d)\1{10}/', $cpf)) { 
            return false;
        }

        // Valida o primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
            $soma += (int)$cpf[$i] * $j;
        }
        $digito1 = $soma % 11 < 2 ? 0 : 11 - ($soma % 11);

        if ((int)$cpf[9] != $digito1) {
            return false;
        }

        // Valida o segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
            $soma += (int)$cpf[$i] * $j;
        }
        $digito2 = $soma % 11 < 2 ? 0 : 11 - ($soma % 11);

        if ((int)$cpf[10] != $digito2) {
            return false;
        }

        return true;
    }

    function cnpj(String $cnpj) {

        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Valida o tamanho
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex: 00.000.000/0000-00), que são inválidos
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += (int)$cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $digito1 = $soma % 11 < 2 ? 0 : 11 - ($soma % 11);

        if ((int)$cnpj[12] != $digito1) {
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += (int)$cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $digito2 = $soma % 11 < 2 ? 0 : 11 - ($soma % 11);

        if ((int)$cnpj[13] != $digito2) {
            return false;
        }

        return true;
    }

    function telefone(String $telefone) {

        $telefone = preg_replace('/[^0-9]/', '', $telefone);

        $regex = '/^([1-9]{2})9?[2-9][0-9]{7}$/';

        return (bool) preg_match($regex, $telefone);

    }

    
}
