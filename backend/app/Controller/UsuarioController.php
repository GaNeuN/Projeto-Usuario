<?php

namespace App\Controller;

use App\Model\Usuario;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\User;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use App\Controller\ValidacoesController;

class UsuarioController extends AbstractController {

    function ajustaData($data) {

        if(strpos($data,"/")>0)
        {
            $d = explode("/",$data);
            $data = $d[2]."-".$d[1]."-".$d[0];
        }

        return $data;
    }

    function ajustaReais($valor) {

        if(strpos($valor,",")>0)
            $valor = str_replace(",",".",str_replace(".","",$valor));

        return $valor;
    }

    function salvar(RequestInterface $request, ResponseInterface $response) {

        $validacoes = new ValidacoesController();

        $mensagem = $validacoes->montaValidacoes($request);

        $dados = $this->tratamentoDados($request);

        if(empty($mensagem))
        {

            $validaExistencia = Usuario::where("cpf_cnpj", $request->input("cpf_cnpj"))->count();
            if(!$validaExistencia>0)
            {
                $usuario = Usuario::create($dados);

                if($usuario->id>0)
                    return $response->withStatus(201)->json(['mensagem'=>"Usuário cadastrado com sucesso."]);
                else
                    return $response->withStatus(400)->json(['mensagem'=>"Erro ao cadastrar Usuário."]);
            }
            else
                return $response->withStatus(400)->json(['mensagem'=>"Usuário já cadastrado no sistema."]);
        }
        else
            return $response->withStatus(400)->json(['mensagem'=>"Erro ao cadastrar Usuário. {$mensagem}"]);
        

    }

    function alterar(RequestInterface $request, ResponseInterface $response) {

        $validacoes = new ValidacoesController();

        $mensagem = $validacoes->montaValidacoes($request);

        $dados = $this->tratamentoDados($request);


        if(empty($mensagem))
        {
            $registro = Usuario::find($request->input('id'));
            $usuario = $registro->update($dados);

            if($usuario)
                return $response->withStatus(201)->json(['mensagem'=>"Usuário alterado com sucesso."]);
            else
                return $response->withStatus(400)->json(['mensagem'=>"Erro ao alterar Usuário."]);
        }
        else
            return $response->withStatus(400)->json(['mensagem'=>"Erro ao alterar Usuário. {$mensagem}"]);
    }

    function listar() {
        $usuarios = Usuario::all();
        return $this->response->json($usuarios);
    }

    function tratamentoDados($dados) {

        $retorno = [
            'nome' => $dados->input("nome"),
            "cpf_cnpj" => $dados->input("cpf_cnpj"),
            "data_nascimento" => $this->ajustaData($dados->input("data_nascimento")),
            "renda_faturamento" => $this->ajustaReais($dados->input("renda_faturamento")),
            "telefone" => $dados->input("telefone"),
            "email" => $dados->input("email")
        ];

        return $retorno;

    }
}
