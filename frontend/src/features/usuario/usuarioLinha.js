import TableRow from '@mui/material/TableRow';
import TableCell from '@mui/material/TableCell';
import EditOutlinedIcon from '@mui/icons-material/EditOutlined';

function UsuarioLinha({linha, onEdit, onDelete}) {
    return(
        <TableRow
              key={linha.nome}
              sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
            >
            <TableCell align="right" sx={{width:50}}><EditOutlinedIcon onClick={() => onEdit(linha)}></EditOutlinedIcon></TableCell>
            <TableCell align="left">{linha.nome}</TableCell>
            
            
        </TableRow>
    );
}

export default UsuarioLinha;
