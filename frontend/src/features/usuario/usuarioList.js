import UsuarioLinha from "./usuarioLinha";
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';

function UsuarioLista({itens, onEdit, onDelete}) {

    if(!itens || itens.length === 0)
        return <p class='mensagemNenhumUsuario'>Nenhum usuário cadastrado</p>

    return(
        <TableContainer component={Paper}>
            <Table sx={{ minWidth: 650, margin:"10px 0px" }} aria-label="simple table">
                <TableHead>
                <TableRow>
                    <TableCell align="right">Alterar</TableCell>
                    <TableCell>Nome</TableCell>
                </TableRow>
                </TableHead>
                <TableBody>
                    {itens.map((item)=>(
                        <UsuarioLinha linha={item} onEdit={onEdit} onDelete={onDelete} ></UsuarioLinha>
                    ))}
                </TableBody>
            </Table>
        </TableContainer>
    )

}

export default UsuarioLista;