import React, {Component} from 'react';
import RaisedButton from 'material-ui/RaisedButton';

export const ProductView = (props) => {
    const {product, addProduct} = props;
    return(
        <div>
            {product && <div>
                <h1>{product.title}</h1>
                <p>Цена: {product.price} {product.currency}</p>
                <p>{product.description}</p>
                <p>Характеристики:</p>
                <ul>
                    <li>Размеры {product.size};</li>
                    <li>Материал {product.material};</li>
                    <li>Вес поддона {product.weight} Кг;</li>
                    <li>Стеллажная нагрузка: {product.load} Кг;</li>
                    <li>Нагрузка в статике: {product.static} Кг;</li>
                    <li>Нагрузка в динамике: {product.dynamic} Кг;</li>
                </ul>
                <RaisedButton
                    label="Купить"
                    secondary={true}
                    onClick={addProduct.bind(null, product.id)}
                />
            </div>}
        </div>
    );
};