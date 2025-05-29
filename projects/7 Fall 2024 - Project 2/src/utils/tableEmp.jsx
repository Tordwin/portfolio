import { styled } from '@mui/material/styles';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import TableCell from '@mui/material/TableCell';
import TableFooter from '@mui/material/TableFooter';
import TablePagination from '@mui/material/TablePagination';
import { CircularProgress } from '@mui/material';
import { useState, useEffect } from 'react';
import getData from '../utils/getData';

const StyledTableCell = styled(TableCell)(({ theme }) => ({
  [`&.${TableCell.head}`]: {
    backgroundColor: '#284b63',
    color: '#e0e1dd',
  },
  [`&.${TableCell.body}`]: {
    fontSize: 14,
  },
}));

const StyledTableRow = styled(TableRow)(({ theme }) => ({
  '&:nth-of-type(odd)': {
    backgroundColor: theme.palette.action.hover,
  },
  '&:last-child td, &:last-child th': {
    border: 0,
  },
}));

// Main Component
export default function CustomizedTables() {
  const [employmentObj, setEmploymentObj] = useState(null);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(5);

  useEffect(() => {
    getData('employment/')
      .then((json) => {
        console.log('Employment data loaded:', json);
        setEmploymentObj(json);
      })
      .catch((error) => console.error('Error fetching employment data:', error));
  }, []);

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
  };

  const handleChangeRowsPerPage = (event) => {
    setRowsPerPage(parseInt(event.target.value, 10));
    setPage(0);
  };

  if (!employmentObj) {
    return (
      <div>
        Loading...<CircularProgress />
      </div>
    );
  }

  //Remove Duplicates
  const noCoopDuplicates = employmentObj.coopTable.coopInformation.filter(
    (emp, index, self) => index === self.findIndex((i) => i.employer === emp.employer)
  );

  const noEmploymentDuplicates =
    employmentObj.employmentTable.professionalEmploymentInformation.filter(
      (emp, index, self) => index === self.findIndex((i) => i.employer === emp.employer)
    );

  return (
      <div id='tableContainer'
        style={{
          display: 'flex',
          justifyContent: 'center',
          gap: '10px',
          padding: '10px',
        }}
      >
        <TableContainer component={Paper}>
          <h2 style={{color: '#284b63', paddingLeft: '20px'}}>Co-op Table</h2>
          <Table aria-label="Co-op Table">
            <TableHead>
              <TableRow>
                <StyledTableCell align="right">Employer</StyledTableCell>
                <StyledTableCell align="right">Degree</StyledTableCell>
                <StyledTableCell align="right">City</StyledTableCell>
                <StyledTableCell align="right">Term</StyledTableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {noCoopDuplicates.slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage).map((emp) => (
                <StyledTableRow key={emp.employer}>
                  <StyledTableCell component="th" scope="row">
                    {emp.employer}
                  </StyledTableCell>
                  <StyledTableCell align="right">{emp.degree}</StyledTableCell>
                  <StyledTableCell align="right">{emp.city}</StyledTableCell>
                  <StyledTableCell align="right">{emp.term}</StyledTableCell>
                </StyledTableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>

        <TableContainer component={Paper}> 
          <h2 style={{color: '#284b63', paddingLeft: '20px'}}>Employment Table</h2>
          <Table aria-label="Employment Table">
            <TableHead>
              <TableRow>
                <StyledTableCell align="right">Employer</StyledTableCell>
                <StyledTableCell align="right">Degree</StyledTableCell>
                <StyledTableCell align="right">City</StyledTableCell>
                <StyledTableCell align="right">Title</StyledTableCell>
                <StyledTableCell align="right">Start Date</StyledTableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {noEmploymentDuplicates.slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage).map((emp) => (
                <StyledTableRow key={emp.employer}>
                  <StyledTableCell component="th" scope="row">
                    {emp.employer}
                  </StyledTableCell>
                  <StyledTableCell align="right">{emp.degree}</StyledTableCell>
                  <StyledTableCell align="right">{emp.city}</StyledTableCell>
                  <StyledTableCell align="right">{emp.title}</StyledTableCell>
                  <StyledTableCell align="right">{emp.startDate}</StyledTableCell>
                </StyledTableRow>
              ))}
            </TableBody>
            <TableFooter>
              <TableRow>
                <TablePagination
                  rowsPerPageOptions={[5, 10, 25, { label: 'All', value: -1 }]}
                  colSpan={5}
                  count={noEmploymentDuplicates.length}
                  rowsPerPage={rowsPerPage}
                  page={page}
                  onPageChange={handleChangePage}
                  onRowsPerPageChange={handleChangeRowsPerPage}
                />
              </TableRow>
            </TableFooter>
          </Table>
        </TableContainer>
      </div>
  );
}
