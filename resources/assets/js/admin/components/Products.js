import React, { Component } from 'react';
import {Link} from 'react-router-dom';
import Pagination from './Pagination';

export default class Products extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            url: "/api/admin/products",
            perPage: 10,
            load: true,
            products: null,
            pagination: null,
            search: "",
            isSearch: false,
            button: false,
            sortBy: "id",
            sort: "asc"
        };
        this.getData = this.getData.bind(this);
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        const prefix = this.state.with ? `&with=${this.state.with}` : "";

        const url = this.state.url.search(/\?/igm) !== -1 ?
            `${this.state.url}&perPage=${this.state.perPage}&sortBy=${this.state.sortBy}&sort=${this.state.sort}${prefix}`
            : `
            ${this.state.url}?perPage=${this.state.perPage}&sortBy=${this.state.sortBy}&sort=${this.state.sort}${prefix}`;

        let settings = {
            "async": true,
            "crossDomain": true,
            "method": "GET",
            "headers": {
                token: this.props.token
            },
            "url": url,
        };

        const self = this;

        axios(settings).then(response => {
            const data = response.data;
            self.setState({
                products: data.data,
                load: false,
                pagination: {
                    next_page: data.next_page_url,
                    prev_page: data.prev_page_url,
                    current_page: data.current_page,
                    last_page: data.last_page,
                    last_page_url: data.last_page_url,
                    url: data.path
                }
            })
        });
    }

    handleDelete(id) {
        if(!confirm("Вы действительно хотите удалить товар ?")) {
            return false;
        }

        let settings = {
            "async": true,
            "crossDomain": true,
            "method": "DELETE",
            "headers": {
                token: this.props.token
            },
            "url": `/api/admin/products/${id}`,
        };

        const self = this;

        axios(settings).then(response => {
            self.getData();
        });
    }

    handlePagination(event) {
        event.preventDefault();
        event.target.blur();
        this.setState({url: event.target.href}, () => {
            this.getData();
        });
    }

    handleInput(event) {
        if(event.target.value) {
            this.setState({button: true})
        } else {
            this.setState({button: false})
        }
        this.setState({search: event.target.value});
    }

    handleSearch() {
        if(!this.state.button) {
            return;
        }
        this.setState({url: `/api/products/search/${this.state.search}`, isSearch: true}, () => {
            this.getData();
        });
    }

    handleChangePerPage(event) {
        this.setState({perPage: event.target.options[event.target.selectedIndex].value}, () => {
            this.getData();
        });
    }

    handleChangeSort(event) {
        this.setState({sort: event.target.options[event.target.selectedIndex].value}, () => {
            this.getData();
        });
    }

    handleChangeSortBy(event) {
        this.setState({sortBy: event.target.options[event.target.selectedIndex].value}, () => {
            this.getData();
        });
    }

    handleSearchBack() {
        this.setState({search: "", isSearch: false, button: false, url: "/api/admin/products"}, () => {
            this.getData();
        });
    }

    render() {
        return (
            <main role="main"
                  className= {this.state.load ?
                      "col-sm-9 ml-sm-auto col-md-10 pt-3 dash__main dash__main_load"
                      :
                      "col-sm-9 ml-sm-auto col-md-10 pt-3 dash__main"}
            >
                {this.state.load ?
                    <div className="loader">
                        <img
                            src="https://idt.taxmann.com/images/loading.gif"
                            alt="Loading"
                            className="loader__image"
                        />
                    </div>
                    :
                    <div>

                        <div className="row">
                            <div className="col-md-8">
                                <h1 className="display-4">Товары</h1>
                            </div>
                            <div className="col-md-4 align-self-center">
                                <Link to="/admin/products/create" type="button" className="btn btn-success btn-block" role="button">
                                    Добавить товар
                                </Link>
                            </div>
                            <div className="col-md-12">
                                <div className="form-group">
                                    <div className="input-group mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Поиск товаров"
                                            aria-label="Поиск товаров"
                                            onChange={(e) => {this.handleInput(e)}}
                                            value={this.state.search}
                                        />
                                        <div className="input-group-append">
                                            {this.state.isSearch &&
                                            <button
                                                className="btn btn-warning"
                                                type="button"
                                                onClick={() => {this.handleSearchBack()}}
                                            >
                                                Вернутся ко всем товарам
                                            </button>
                                            }
                                            <button
                                                className={this.state.button ?
                                                    "btn btn-primary"
                                                    :
                                                    "btn btn-primary disabled"
                                                }

                                                type="button"
                                                onClick={() => {this.handleSearch()}}
                                            >
                                                Поиск
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="col-md-12">
                                <div className="form-group row">

                                    <label className="col-md-2 col-form-label">Количество товаров на странице:</label>
                                    <div className="col-md-2 align-self-center">
                                        <select
                                            id="perPage"
                                            className="custom-select custom-select-md"
                                            onChange={(e) => {this.handleChangePerPage(e)}}
                                        >
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                        </select>
                                    </div>

                                    <label className="col-md-2 align-self-center col-form-label">Сортировать по:</label>
                                    <div className="col-md-2 align-self-center">
                                        <select
                                            id="sort"
                                            className="custom-select custom-select-md"
                                            onChange={(e) => {this.handleChangeSortBy(e)}}
                                        >
                                            <option value="id">Id</option>
                                            <option value="created_at">Дате создания</option>
                                            <option value="title">Названию</option>
                                            <option value="material">Материалу</option>
                                            <option value="size">Размерам</option>
                                            <option value="static">Нагрузке в статике</option>
                                            <option value="dynamic">Нагрузке в динамике</option>
                                            <option value="price">Цене</option>
                                            <option value="categories.name">Категории</option>
                                            <option value="availability">Наличию</option>
                                        </select>
                                    </div>

                                    <label className="col-md-2 align-self-center col-form-label">Порядок сортировки:</label>
                                    <div className="col-md-2 align-self-center">
                                        <select
                                            id="sort"
                                            className="custom-select custom-select-md"
                                            onChange={(e) => {this.handleChangeSort(e)}}
                                        >
                                            <option value="asc">По возрастанию</option>
                                            <option value="desc">По убыванию</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div className="col-md-12">
                                <div className="table-responsive">
                                    <table className="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Название</th>
                                            <th scope="col">Описание</th>
                                            <th scope="col">Категория</th>
                                            <th scope="col">Материал</th>
                                            <th scope="col">Размеры</th>
                                            <th scope="col">Статика</th>
                                            <th scope="col">Динамика</th>
                                            <th scope="col">Цена</th>
                                            <th scope="col">Наличие</th>
                                            <th scope="col" className="dashboard__table-actions">Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {this.state.products.map((product) => {
                                           return( <ProductBlock
                                                key={product.id}
                                                id={product.id}
                                                title={product.title}
                                                description={product.description}
                                                price={product.price}
                                                staticWeight={product.static}
                                                dynamic={product.dynamic}
                                                size={product.size}
                                                material={product.material}
                                                category={product.category.name}
                                                availability={product.availability}
                                                deleteProduct={() => {
                                                    this.handleDelete(product.id)
                                                }}
                                            /> )
                                        })}
                                        </tbody>
                                    </table>
                                </div>
                                <div className="col-md-12">
                                    <Pagination
                                        pagination={this.state.pagination}
                                        handleClick={(e) => {this.handlePagination(e)}}
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                }
            </main>
        );
    }
}

const ProductBlock = (props) => {
    const {id, title, description, category, deleteProduct, staticWeight, dynamic, price, size, material, availability} = props;
    return(
        <tr>
            <th scope="row">{id}</th>
            <td>{title}</td>
            <td>{description}</td>
            <td>{category}</td>
            <td>{material}</td>
            <td>{size}</td>
            <td>{staticWeight}</td>
            <td>{dynamic}</td>
            <td>{price}</td>
            <td>{availability ? "Есть" : "Нету"}</td>
            <td className="dashboard__table-actions">
                <div className="btn-group" role="group">
                    <Link
                        type="button"
                        role="button"
                        className="btn btn-secondary"
                        to={`/admin/products/edit/${id}`}
                    >
                        Редактировать
                    </Link>
                    <button
                        type="button"
                        className="btn btn-secondary btn-danger"
                        onClick={deleteProduct}
                    >
                        Удалить
                    </button>
                </div>
            </td>
        </tr>
    );
};


