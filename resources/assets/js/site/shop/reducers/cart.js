export default function cart(state = [], action)
{
    switch (action.type) {
        case "FETCH_PRODUCTS_FOR_CART_SUCCESS":
            return {products: action.payload};
        case "ADD_PRODUCT_FOR_CART_SUCCESS":
            return {products: action.payload};
    }

    return state;
}