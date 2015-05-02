'use strict';

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
                    <FileList />
                </main>
            </div>
        )
    }
}

React.render(
    <OnlineFtp />,
    document.getElementById('app')
);