import React, {Component} from 'react';
import RaisedButton from 'material-ui/RaisedButton';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import TextField from 'material-ui/TextField';
import {connect} from "react-redux";
import {withRouter} from "react-router-dom";
import {getProducts, addProduct} from '../actions/cart';
import {getUser} from "../actions/getUser";

class Cart extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            confirm: false,
            phone_number: "",
            user_name: "",
            complete: false,
            button: false
        };

        this.addProduct = this.addProduct.bind(this);
        this.deleteProduct = this.deleteProduct.bind(this);
        this.confirmOrder = this.confirmOrder.bind(this);
        this.changeNumber = this.changeNumber.bind(this);
        this.completeOrder = this.completeOrder.bind(this);
        this.continueShop = this.continueShop.bind(this);
    }

    addProduct(id) {
        this.props.addProduct({product_id: id}).then(() => $(".cart__modal").fadeIn(500));
    }

    deleteProduct(id) {
        let settings = {
            url: `/cart/${id}`,
            "async": true,
            "crossDomain": true,
            "method": "DELETE",
        };

        const success = axios(settings).then(response =>  {
            this.props.getProducts();
        });
    }

    componentWillMount() {
        this.props.getProducts();
        this.props.getUser({url: '/user'});
    }

    continueShop() {
        this.setState({complete: false});
        $(".cart__modal").fadeOut(500);
    }

    confirmOrder() {
        this.setState({confirm: !this.state.confirm});
    }

    changeNumber(event) {
        const value = event.target.value;
        if(value.search(/[^0-9\-\s+]/igm) !== -1) {
            alert("В телефоне могут содержаться только цифры!");
            return false;
        } else if(this.state.phone_number.length < 10) {
            this.setState({button: false});
        } else {
            this.setState({button: true});
        }
        this.setState({phone_number: value});
    }

    handleInput(event) {
        this.setState({
            [event.target.name]: event.target.value
        })
    }

    completeOrder() {
        if(this.state.phone_number.length < 10) {
            alert("Введите коректный телефон!");
            return false;
        }

        let settings = {
            url: "/order",
            async: true,
            crossDomain: true,
            method: "POST",
            data: {
                phone_number: this.state.phone_number,
                user_name: this.state.user_name
            }
        };

        const success = axios(settings).then(response =>  {
            this.setState({phone_number: "", confirm: false, complete: true});
            this.props.getProducts({url: "/cart"});
        });
    }

    render() {
        const {phone_number, confirm, complete, button, user_name} = this.state;
        const {products} = this.props;
        return(
            <CartView
                products={products}
                continueShop={this.continueShop}
                deleteProduct={this.deleteProduct}
                confirm={confirm}
                confirmOrder={this.confirmOrder}
                number={phone_number}
                changeNumber={this.changeNumber}
                completeOrder={this.completeOrder}
                complete={complete}
                button={button}
                user_name={user_name}
                handleInput={(e) => this.handleInput(e)}
                user={this.props.user}
            />
        );
    }
}

const CartView = (props) => {
    const {products, continueShop, deleteProduct, confirm, changeNumber, number, confirmOrder, completeOrder,
    complete, button, user_name, handleInput, user} = props;
    console.log(user);
    return(
        <MuiThemeProvider>
            <div className="cart__modal">
                <div className="cart">
                    {!confirm ?
                        <div className="cart__content">
                            {complete ?
                                <h4 style={{marginBottom: "20px"}}>Спасибо за заказ, наш оператор скоро свяжется с вами!</h4>
                                :
                                <ul className="cart__list">
                                    {products && products.length ? products.map((product) => (
                                        <li key={product.id} className="cart__item">
                                            <div className="cart__img-container">
                                                <img
                                                    className="cart__img"
                                                    src={product.title_image}
                                                    alt={product.title}
                                                />
                                            </div>
                                            <p className="cart__name">{product.title}</p>
                                            <p className="cart__name">Цена: {product.price} Грн</p>
                                            <i
                                                className="fas fa-times cart__content-delete"
                                                onClick={deleteProduct.bind(null, product.id)}
                                            />
                                        </li>
                                    )) : <li style={{marginBottom: "20px"}}>Вы ещё ничего не добавили в корзину</li>}
                                </ul>
                            }
                            {/*totalPrice ? <p>Сумарная стоимость заказа: {totalPrice} Грн</p> : ""*/}
                            <div className="cart__buttons">
                                <RaisedButton
                                    label="Оформить заказ"
                                    secondary={true}
                                    disabled={products && !products.length}
                                    style={{marginRight: "20px"}}
                                    onClick={confirmOrder}
                                />
                                <RaisedButton
                                    label="Продолжить покупки"
                                    primary={true}
                                    onClick={continueShop}
                                />
                            </div>
                        </div>
                    :
                        <div className="cart__content">
                            {(!user || !Object.keys(user).length) && <TextField
                                onChange={handleInput}
                                floatingLabelText="Ваше имя"
                                value={user_name}
                                fullWidth={true}
                                name="user_name"
                            />}
                            <TextField
                                style={{marginBottom: "20px"}}
                                onChange={changeNumber}
                                floatingLabelText="Введите ваш номер телефона"
                                value={number}
                                fullWidth={true}
                            />
                            <br/>
                            <RaisedButton
                                label="Подтвердить заказ"
                                secondary={true}
                                onClick={completeOrder}
                                style={{marginRight: "20px"}}
                                disabled={!button}
                            />
                            <RaisedButton
                                label="Вернуться назад"
                                primary={true}
                                onClick={confirmOrder}
                            />
                        </div>
                    }
                </div>
            </div>
        </MuiThemeProvider>
    );
};



const mapStateToProps = state => ({
    products: state.cart.products,
    user: state.user
});

const mapDispatchToProps = dispatch => ({
    getProducts: (params) => {
        return dispatch(getProducts(params));
    },
    addProduct: (params) => {
        return dispatch(addProduct(params));
    },
    getUser: (params) => {
        dispatch(getUser(params));
    },
});

export default connect(
    mapStateToProps,
    mapDispatchToProps,
)(withRouter(Cart));