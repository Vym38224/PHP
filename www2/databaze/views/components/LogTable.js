
const { useState, useEffect } = React;

function LogTable({ logs }) {
    const [visibleLogs, setVisibleLogs] = useState(logs);
    const [logCount, setLogCount] = useState(10);

    useEffect(() => {
        const deletedLogs = JSON.parse(localStorage.getItem('deletedLogs')) || [];
        const filteredLogs = logs.filter(log => !deletedLogs.includes(log.id));
        setVisibleLogs(filteredLogs);
    }, [logs]);

    const handleDelete = (index) => {
        const logToDelete = visibleLogs[index];
        const newLogs = visibleLogs.filter((_, i) => i !== index);
        setVisibleLogs(newLogs);

        const deletedLogs = JSON.parse(localStorage.getItem('deletedLogs')) || [];
        deletedLogs.push(logToDelete.id);
        localStorage.setItem('deletedLogs', JSON.stringify(deletedLogs));
    };

    const handleLogCountChange = (event) => {
        setLogCount(event.target.value);
    };

    return (
        <div>
            <div>
                <label>
                    Počet zobrazených logů:
                    <input
                        type="number"
                        value={logCount}
                        onChange={handleLogCountChange}
                        min="1"
                        max={logs.length}
                    />
                </label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Příjmení</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Pracovna</th>
                        <th>Popis</th>
                        <th>Je Správce</th>
                        <th>Čas přihlášení</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    {visibleLogs.slice(0, logCount).map((log, index) => (
                        <tr key={index}>
                            <td>{log.first_name}</td>
                            <td>{log.last_name}</td>
                            <td>{log.email}</td>
                            <td>{log.mobile}</td>
                            <td>{log.room}</td>
                            <td>{log.life}</td>
                            <td>{log.is_admin}</td>
                            <td>{log.login_time}</td>
                            <td>
                                <button onClick={() => handleDelete(index)}>Smazat</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}