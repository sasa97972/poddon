import React, { Component } from 'react';
import {BrowserRouter as Router, Route} from 'react-router-dom';

import Dashboard from './components/Dashboard';
import DashboardMenu from './components/DashboardMenu';
import Categories from './components/Categories';
import CreateCategory from './components/CreateCategory';
import EditCategory from './components/EditCategory';
import Products from './components/Products';
import CreateProduct from './components/CreateProduct';
import EditProduct from './components/EditProduct';
import AddImages from './components/AddImages';
import Comments from './components/Comments';
import EditComment from './components/EditComment';
import Users from './components/Users';
import EditUser from './components/Edituser';
import Orders from './components/Orders';
import {Layout} from './components/BasicLayout';

class App extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            token: "verySecretToken",
        }
    }

    render() {
        return(
            <Router>
                <Layout>
                    <DashboardMenu/>
                    <Route path="/admin/" exact render={(props) => (
                        <Dashboard {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/categories" exact render={(props) => (
                        <Categories {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/categories/create" render={(props) => (
                        <CreateCategory {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/categories/edit/:categoryId" render={(props) => (
                        <EditCategory {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/products" exact render={(props) => (
                        <Products {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/products/create" exact render={(props) => (
                        <CreateProduct {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/images/:product_id" exact render={(props) => (
                        <AddImages {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/products/edit/:product_id" exact render={(props) => (
                        <EditProduct {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/comments" exact render={(props) => (
                        <Comments {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/comments/edit/:commentId" exact render={(props) => (
                        <EditComment {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/users" exact render={(props) => (
                        <Users {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/users/edit/:user_id" exact render={(props) => (
                        <EditUser {...props} token={this.state.token}/>
                    )}/>
                    <Route path="/admin/orders" exact render={(props) => (
                        <Orders {...props} token={this.state.token}/>
                    )}/>
                </Layout>
            </Router>
        )
    }
}

export default App;