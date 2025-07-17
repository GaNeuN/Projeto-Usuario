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

    function salvar(RequestInterface $request, ResponseInterface $response) {

        $validacoes = new ValidacoesController();

        $validaCPF = $validacoes->cpf($request->input("cpf_cnpj"));
        $validaCNPJ = $validacoes->cnpj($request->input("cpf_cnpj"));
        $validaTelefone = $validacoes->telefone($request->input("telefone"));

        $dados = [
            'nome' => $request->input("nome"),
            "cpf_cnpj" => $request->input("cpf_cnpj"),
            "data_nascimento" => $request->input("data_nascimento"),
            "renda_faturamento" => $request->input("renda_faturamento"),
            "telefone" => $request->input("telefone"),
            "email" => $request->input("email")
        ];
        $mensagem = '';
        
        $tamCPFCNPJ = strlen(str_replace("-","",str_replace(".","",$request->input("cpf_cnpj"))));

        if(!$validaCPF && $tamCPFCNPJ <=11)
            $mensagem .= ", CPF Inválido";

        if(!$validaCNPJ && $tamCPFCNPJ>11)
            $mensagem  .= ", CNPJ Inválido";

        if(!$validaTelefone)
            $mensagem .= ", Telefone Inválido";

        $mensagem = substr($mensagem,1,strlen($mensagem));


        if(empty($mensagem))
        {
            $usuario = Usuario::create($dados);



            if($usuario->id>0)
                return $response->withStatus(201)->json(['mensagem'=>"Usuário cadastrado com sucesso."]);
            else
                return $response->withStatus(500)->json(['mensagem'=>"Erro ao cadastrar Usuário."]);
        }
        else
        {
            return $response->withStatus(500)->json(['mensagem'=>"Erro ao cadastrar Usuário. <br/>{$mensagem}"]);
        }
        
        //return $response->json(['usuario_id' => $usuario->id, "message"=>'Inserido com sucesso']);

    }

    function alterar(RequestInterface $request, ResponseInterface $response) {

        $validacoes = new ValidacoesController();

        $validaCPF = $validacoes->cpf($request->input("cpf_cnpj"));
        $validaCNPJ = $validacoes->cnpj($request->input("cpf_cnpj"));
        $validaTelefone = $validacoes->telefone($request->input("telefone"));

        $dados = [
            'nome' => $request->input("nome"),
            "cpf_cnpj" => $request->input("cpf_cnpj"),
            "data_nascimento" => $request->input("data_nascimento"),
            "renda_faturamento" => $request->input("renda_faturamento"),
            "telefone" => $request->input("telefone"),
            "email" => $request->input("email")
        ];

        $mensagem = '';
        
        $tamCPFCNPJ = strlen(str_replace("-","",str_replace(".","",$request->input("cpf_cnpj"))));

        if(!$validaCPF && $tamCPFCNPJ <=11)
            $mensagem .= ", CPF Inválido";

        if(!$validaCNPJ && $tamCPFCNPJ>11)
            $mensagem  .= ", CNPJ Inválido";

        if(!$validaTelefone)
            $mensagem .= ", Telefone Inválido";

        $mensagem = substr($mensagem,1,strlen($mensagem));

        if(empty($mensagem))
        {
            $registro = Usuario::find($request->input('id'));
            $usuario = $registro->update($dados);

            if($usuario)
                return $response->withStatus(201)->json(['mensagem'=>"Usuário alterado com sucesso."]);
            else
                return $response->withStatus(500)->json(['mensagem'=>"Erro ao alterar Usuário."]);
        }
        else
            return $response->withStatus(500)->json(['mensagem'=>"Erro ao alterar Usuário. {$mensagem}"]);
    }

    function listar() {
        $usuarios = Usuario::all();
        return $this->response->json($usuarios);
    }

}
