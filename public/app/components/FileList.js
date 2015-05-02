'use strict';
class FileList extends React.Component {
    render() {
        return (
            <table className="table table-filelist table--striped is-clickable">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Dateiname</th>
                    <th className="text-right">Berechtigung</th>
                    <th className="text-right">Dateigrösse</th>
                    <th className="text-right">Datum</th>
                    <th className="text-right">Aktionen</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td>Fld</td>
                    <td>A</td>
                    <td className="text-right">A</td>
                    <td className="text-right">A</td>
                    <td className="text-right">A</td>
                    <td className="text-right">X Y</td>
                </tr>
                </tbody>
            </table>
        )
    }
}
