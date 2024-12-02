const { useState, useEffect } = React;

function LogTable({ logs }) {
    const [visibleLogs, setVisibleLogs] = useState(logs);
    const [logCount, setLogCount] = useState(10);

    useEffect(() => {
        const deletedLogs = JSON.parse(localStorage.getItem('deletedLogs')) || [];
        const filteredLogs = logs.filter(log => !deletedLogs.includes(log.id));
        setVisibleLogs(filteredLogs);
    }, [logs]);

    const handleDelete = async (logId) => {
        const logToDelete = visibleLogs.find(log => log.id === logId);
        const newLogs = visibleLogs.filter(log => log.id !== logId);
        setVisibleLogs(newLogs);

        const deletedLogs = JSON.parse(localStorage.getItem('deletedLogs')) || [];
        deletedLogs.push(logToDelete.id);
        localStorage.setItem('deletedLogs', JSON.stringify(deletedLogs));

        // Make an API call to delete the log entry on the server
        try {
            const response = await fetch('http://localhost/www2/databaze/controllers/LoginController.php/api/delete-log', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ loginTime: logToDelete.login_time }),
            });

            if (!response.ok) {
                throw new Error('Failed to delete log entry on the server');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const handleLogCountChange = (event) => {
        setLogCount(event.target.value);
    };

    return (
        <div style={styles.container}>
            <div style={styles.control}>
                <label>
                    Počet zobrazených logů:
                    <input
                        type="number"
                        value={logCount}
                        onChange={handleLogCountChange}
                        style={styles.input}
                    />
                </label>
            </div>
            <table style={styles.table}>
                <thead>
                    <tr>
                        <th>Login Time</th>
                        <th>Jméno</th>
                        <th>Příjmení</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Pracovna</th>
                        <th>Popis</th>
                        <th>Je Správce</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    {visibleLogs.slice(0, logCount).map((log) => (
                        <tr key={log.id} style={styles.row}>
                            <td>{log.login_time}</td>
                            <td>{log.first_name}</td>
                            <td>{log.last_name}</td>
                            <td>{log.email}</td>
                            <td>{log.mobile}</td>
                            <td>{log.room}</td>
                            <td>{log.life}</td>
                            <td>{log.is_admin ? 'Ano' : 'Ne'}</td>
                            <td>
                                <button onClick={() => handleDelete(log.id)} style={styles.button}>Smazat</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

const styles = {
    container: {
        padding: '20px',
        fontFamily: 'Arial, sans-serif',
    },
    control: {
        marginBottom: '20px',
    },
    input: {
        marginLeft: '10px',
        padding: '5px',
        fontSize: '14px',
    },
    table: {
        width: '100%',
        borderCollapse: 'collapse',
    },
    row: {
        borderBottom: '1px solid #ddd',
    },
    th: {
        backgroundColor: '#f2f2f2',
        padding: '10px',
        textAlign: 'left',
    },
    td: {
        padding: '10px',
        textAlign: 'left',
    },
    button: {
        padding: '5px 10px',
        backgroundColor: '#f44336',
        color: 'white',
        border: 'none',
        borderRadius: '3px',
        cursor: 'pointer',
    },
    buttonHover: {
        backgroundColor: '#d32f2f',
    },
};