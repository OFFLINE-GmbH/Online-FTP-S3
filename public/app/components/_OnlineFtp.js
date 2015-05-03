'use strict';

import FileTree from './FileTree'
import Breadcrumbs from './Breadcrumbs'
import Toolbar from './Toolbar'
import FileList from './FileList'

class OnlineFtp extends React.Component {
    render() {
        return (
            <div>
                <aside className="sidebar">
                    <FileTree />
                </aside>
                <main className="main">
                    <Breadcrumbs />
                    <Toolbar />
                    <FileList path="" />
                </main>
            </div>
        )
    }
}
React.render(<OnlineFtp/>, document.getElementById('app'));

export default OnlineFtp;