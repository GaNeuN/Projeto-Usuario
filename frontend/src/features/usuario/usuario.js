import React, { useState } from 'react';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import axios from 'axios';
import UsuarioLista from './usuarioList';
import UsuarioFormulario from './usuarioFormulario';
import Alert from '@mui/material/Alert';
import Stack from '@mui/material/Stack';
import Button from '@mui/material/Button';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';

const api = axios.create({
    baseUrl: "http://localhost:9501/"
});

function Usuario() {

    const queryClient = useQueryClient();
    const [showForm, setShowForm] = useState(false);
    const [editarUsuario, setEditarUsuario] = useState(null);
    const [statusMessage, setStatusMessage] = useState(null);
    const [status, setStatus] = useState(null);
    let estado = null;

    const { data: itens } = useQuery ({
        queryKey: ['itens'],
        queryFn: async() => {
            const response = await api.get("http://localhost:9501/usuarios");
            return response.data;
        }
    });

    const inserirUsuario = useMutation({
        mutationFn: (novoUsuario) => api.post("http://localhost:9501/criarusuario",novoUsuario),
        onSuccess: (data) => {
            /*queryClient.invalidadeQueries({
                queryKey: ['usuarios']
            });*/
            setShowForm(false);
            setStatus(1);
            
            setStatusMessage(data.data.mensagem);
        },
        onError: (error) => {
            setShowForm(false);
            console.error("Erro ao cadastrar usuário",error);
            setStatus(2);
            setStatusMessage(error.response.data.mensagem);
        }
    });

    const alterarUsuario = useMutation({
        mutationFn: (alteradoUsuario) => api.post(`http://localhost:9501/editarusuario`,alteradoUsuario),
        onSuccess: (data) => {
            /*queryClient.invalidadeQueries({
                queryKey: ['usuarios']
            });*/
            setShowForm(false);
            setEditarUsuario(null);
            setStatus(1);
            
            setStatusMessage(data.data.mensagem);
        },
        onError: (error) => {
            setShowForm(false);
            console.error("Erro ao alterar usuário",error);
            setStatus(2);
            setStatusMessage(error.response.data.mensagem);
        }
    });

    

    const handleOpenFormForCreate = () => {
        setEditarUsuario(null);
        setShowForm(true);
    }

    const handleOpenFormForEdit = (item) => {
        setEditarUsuario(item);
        setShowForm(true);
    }

    const handleFormSubmit = (data) => {
        if(editarUsuario) {
            alterarUsuario.mutate(data);
        }
        else
        {
            inserirUsuario.mutate(data);
        }
    }

    const showMessage = (status, statusMessage) => {
        if(status>0)
        {
            if(status === 2)
                estado = "error";
            else
                estado = "success";

            return (<Stack sx={{ width: '100%', margin:'10px 0px' }} spacing={2}>
                <Alert variant="filled" severity={estado}>
                    {statusMessage}
                </Alert>
            </Stack>)

        }
    }
    
    return (
        <div>
            <h1>Usuários</h1>
            <Button variant='contained' sx={{margin:'10px 0px'}} startIcon={<AddBoxOutlinedIcon/>} onClick={handleOpenFormForCreate}>Novo Usuário</Button>
            {
                showMessage(status,statusMessage)
            }
            {showForm && (
                <UsuarioFormulario
                    dados={editarUsuario}
                    onSubmit={handleFormSubmit}
                    onCancel={() => setShowForm(false)}

                />
            )}
            <br/>
            <UsuarioLista itens={itens} onEdit={handleOpenFormForEdit} />
        </div>
    )
}

export default Usuario;