const validaData = (data) => {
    //Validação de data no formato dd/mm/yyyy
    const regex = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!regex.test(data)) 
        return false;
    else
        return true;
}

const validaCPF = (cpf) => {
    //Validação de CPF no formato 000.000.000-00 ou 00000000000
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) 
        return false;
    else
        return true;
    
}

const validaCNPJ = (cnpj) => {
    //Validação de CNPJ no formato 00.000.000/0000-00 ou 00000000000000
    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj.length !== 14 || /^(\d)\1{13}$/.test(cnpj)) 
        return false;
    else
        return true;

}

const validaEmail = (email) => {
    //Validação de e-mail simples
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);

}

const validaTelefone = (telefone) => {
    //Validação de telefone no formato (00) 0000-0000 ou (00) 00000-0000
    telefone = telefone.replace(/[^\d]+/g, '');

    const regex = /^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/;
    return regex.test(telefone);

}

const validaValor = (valor) => {
    //Validação de valores para contar ",00" e possibilidade de "." como separador de milhar
    const regex = /^\d{1,3}(?:\.\d{3})*,\d{2}$/;
    return regex.test(valor);
}

const validaCampos = (dados) => {
    console.log(dados);
    let mensagem = "";
    if(dados.nome.length < 3)
        mensagem = mensagem + ", Nome deve ter pelo menos 3 caracteres";
    if(!validaCPF(dados.cpf_cnpj) && ((dados.cpf_cnpj).replace(/[^\d]+/g, '')).length <= 11)
        mensagem = mensagem + ", CPF inválido";
    else if(!validaCNPJ(dados.cpf_cnpj) && ((dados.cpf_cnpj).replace(/[^\d]+/g, '')).length > 11)
        mensagem = mensagem + ", CNPJ inválido";
    if(!validaData(dados.data_nascimento))
        mensagem = mensagem + ", Data de nascimento inválida";
    if(!validaValor(dados.renda_faturamento) && ((dados.cpf_cnpj).replace(/[^\d]+/g, '')).length === 11)
        mensagem = mensagem + ", Renda inválida";
    else if(!validaValor(dados.renda_faturamento) && ((dados.cpf_cnpj).replace(/[^\d]+/g, '')).length === 14)
        mensagem = mensagem + ", Faturamento inválido";
    if(!validaEmail(dados.email))
        mensagem = mensagem + ", E-mail inválido";
    if(!validaTelefone(dados.telefone))
        mensagem = mensagem + ", Telefone inválido";

    mensagem = mensagem.substring(1, mensagem.length);

    return mensagem;

}

export default validaCampos;