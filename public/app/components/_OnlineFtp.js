'use strict';
var Router = window.ReactRouter;
var Route = Router.Route;
var DefaultRoute = Router.DefaultRoute;
var RouteHandler = Router.RouteHandler;

var routes = (
    <Route handler={App}>
        <DefaultRoute handler={OnlineFtp}/>

        <Route path="dir/:path" handler={OnlineFtp}/>
    </Route>
);
class OnlineFtp extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            path: props.params.path
        }
    }

    render() {
        return (
            <div>
                <aside className="sidebar">
                    <FileTree />
                </aside>
                <main className="main">
                    <Breadcrumbs />
                    <Toolbar />
                    <FileList path={this.state.path} />
                </main>
            </div>
        )
    }
}



class App extends React.Component {
    render() {
        return (
            <div>
                <RouteHandler />
            </div>
        );
    }
}

Router.run(routes, Router.HistoryLocation, (Root) => {
    React.render(<Root/>, document.getElementById('app'));
});
//function render() {
//    var route = window.location.hash.substr(1);
//    React.render(<OnlineFtp route={route}/>, document.getElementById('app'));
//}
//window.addEventListener('hashchange', render);
//render();