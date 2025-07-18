import React, { useState, useEffect } from 'react';

import Box from '@mui/material/Box';
import Modal from '@mui/material/Modal';
import TextField from '@mui/material/TextField';
import Grid from '@mui/material/Grid';
import Button from '@mui/material/Button';
import DeleteIcon from '@mui/icons-material/Delete';
import SaveAsOutlinedIcon from '@mui/icons-material/SaveAsOutlined';


function UsuarioFormulario({dados, onSubmit, onCancel, onStatusMessage, onStatus}) {
    const [nome, setNome] = useState("");
    const [cpf_cnpj, setCPFCNPJ] = useState("");
    const [data_nascimento, setDataNascimento] = useState("");
    const [renda_faturamento, setRendaFaturamento] = useState("");
    const [telefone, setTelefone] = useState("");
    const [email, setEmail] = useState("");
    const [id, setId] = useState("");
    const [open, setOpen] = useState(true);
    let estado = null;

    useEffect(() => {
        if(dados) {
            setNome(dados.nome);
            setCPFCNPJ(dados.cpf_cnpj);
            setDataNascimento(arrumaData(dados.data_nascimento));
            setRendaFaturamento((dados.renda_faturamento.toLocaleString('pt-br', {minimumFractionDigits: 2})));
            setTelefone(dados.telefone);
            setEmail(dados.email);
            setId(dados.id);
        }
        else
        {
            setNome("");
            setCPFCNPJ("");
            setDataNascimento("");
            setRendaFaturamento("");
            setTelefone("");
            setEmail("");
            setId("");
        }
    }, [dados]);

    const arrumaData = (data) => {
        let d = data.split("-");
        return d[2]+"/"+d[1]+"/"+d[0];
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        
        onSubmit({ nome, cpf_cnpj, data_nascimento, renda_faturamento, email, telefone,id });
    };

    

    const style = {
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: 500,
        bgcolor: 'background.paper',
        border: '2px solid #000',
        boxShadow: 24,
        p: 4,
    };

    return (
        <Modal
            open={open}
            onClose={onCancel}
            aria-labelledby="modal-modal-title"
            aria-describedby="modal-modal-description"
        >
            <Box sx={style}>
                <form onSubmit={handleSubmit}>
                    <h2>{dados ? 'Alterar Usuário' : 'Novo Usuário'}</h2>
                    <input type='hidden' name="id" value={id} />
                    <Grid container spacing={2}>
                        
                        
                        <Grid size={6} spacing={2}>
                            <TextField id="nome" label="Nome" variant="outlined" onChange={(e) => setNome(e.target.value)} value={nome} required/>
                        </Grid>   
                        <Grid size={6}> 
                            <TextField id="cpf_cnpj" label="CPF/CNPJ" variant="outlined" onChange={(e) => setCPFCNPJ(e.target.value)} value={cpf_cnpj} required/>
                            
                        </Grid>
                        <Grid size={6}>
                            <TextField id="data_nascimento" label={(cpf_cnpj.replace(/[^0-9]/g, '')).length > 11 ? 'Data de Fundação' : 'Data de Nascimento'} variant="outlined" onChange={(e) => setDataNascimento(e.target.value)} value={data_nascimento} required/>
                        </Grid>        
                        <Grid size={6}>
                            <TextField id="renda_faturamento" label={(cpf_cnpj.replace(/[^0-9]/g, '')).length > 11 ? 'Faturamento' : 'Renda'} variant="outlined" onChange={(e) => setRendaFaturamento(e.target.value)} value={renda_faturamento} required/>                        
                        </Grid>
                        <Grid size={6}>
                            <TextField id="telefone" label="Telefone" variant="outlined" onChange={(e) => setTelefone(e.target.value)} value={telefone} required/>                        
                        </Grid>
                        <Grid size={6}>
                            <TextField id="email" label="E-mail" variant="outlined" onChange={(e) => setEmail(e.target.value)} value={email} />                        
                        </Grid>
                    
                    
                    <Button variant="contained" startIcon={<SaveAsOutlinedIcon />} type="submit">{dados ? 'Salvar' : 'Cadastrar'}</Button>
                    <Button variant="outlined" startIcon={<DeleteIcon />}  type="button" onClick={onCancel}>Cancelar</Button>
                    </Grid>
                </form>
            </Box>
        </Modal>
    );

}

export default UsuarioFormulario;