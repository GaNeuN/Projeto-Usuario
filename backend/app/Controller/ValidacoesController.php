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

    function nome (String $nome) {

        if(strlen($nome) > 3)
            return true;
        else
            return false;

    }

    function reais (String $valor) {

        $v = str_replace(",","",str_replace(".","",$valor));

        if(strlen($v)>3 && ctype_digit($v))
            return true;
        else
            return false;
    }

    function email(String $email) {

        if(strlen($email)>3)
            return (bool) preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email);
        else
            return true;

    }

    function data(String $data) {

        
        $regex = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d\d$/';

        if (preg_match($regex, $data)) {
            return true;
        } else {
            return false;
        }

    }
    

    function montaValidacoes($dados) {

        $validaCPF = $this->cpf($dados->input("cpf_cnpj"));
        $validaCNPJ = $this->cnpj($dados->input("cpf_cnpj"));
        $validaTelefone = $this->telefone($dados->input("telefone"));
        $validaNome = $this->nome($dados->input("nome"));
        $validaReais = $this->reais($dados->input("renda_faturamento"));
        $validaData = $this->data($dados->input("data_nascimento"));
        $validaEmail = $this->email($dados->input("email"));

        $tamCPFCNPJ = strlen(str_replace("/","",str_replace("-","",str_replace(".","",$dados->input("cpf_cnpj")))));
        $mensagem = '';
        if(!$validaNome)
            $mensagem .= ", Nome Inválido";

        if(!$validaCPF && $tamCPFCNPJ <=11)
            $mensagem .= ", CPF Inválido";

        if(!$validaCNPJ && $tamCPFCNPJ>11)
            $mensagem  .= ", CNPJ Inválido";

        if(!$validaData && $tamCPFCNPJ ===11)
            $mensagem .= ", Data de Nascimento Inválida";

        if(!$validaData && $tamCPFCNPJ ===14)
            $mensagem .= ", Data de Fundação Inválida";

        if(!$validaReais && $tamCPFCNPJ ===11)
            $mensagem .= ", Renda Inválida";

        if(!$validaReais && $tamCPFCNPJ ===14)
            $mensagem .= ", Faturamento Inválido";
        
        if(!$validaTelefone)
            $mensagem .= ", Telefone Inválido";

        if(!$validaEmail)
            $mensagem .= ", E-mail Inválido";


        $mensagem = substr($mensagem,1,strlen($mensagem));

        return $mensagem;
    }

}
