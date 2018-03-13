import React from 'react';
import Checkbox from 'material-ui/Checkbox';
import {List, ListItem} from 'material-ui/List';
import Subheader from 'material-ui/Subheader';
import Divider from 'material-ui/Divider';
import 'react-select/dist/react-select.css';
import InputRange from 'react-input-range';
import 'react-input-range/lib/css/index.css';

export const SideBar = (props) => {
    const {filter, checkCategories, price, changePrice, checkFilter} = props;
    return(
        <aside className="col-md-3">
            <List>
                <Subheader>Фильтр для товаров</Subheader>

                <ListItem
                    primaryText="Категории"
                />
                <div className="row">
                    {filter.categories && filter.categories.categories.length && filter.categories.categories.map((category, index) => (
                        <div className="col-md-6 filter__item" key={index}>
                            <Checkbox
                                label={category.name}
                                checked={category.check}
                                onCheck={checkCategories.bind(null, category.name)}
                            />
                        </div>
                    ))}
                </div>

                <br/><Divider/>

                <ListItem
                    primaryText="Размеры"
                />
                <div className="row">
                    {filter.size && filter.size.size.length && filter.size.size.map((size, index) => (
                        <div className="col-md-6 filter__item" key={index}>
                            <Checkbox
                                label={size.size}
                                checked={size.check}
                                onCheck={checkFilter.bind(null, "size", size.size)}
                            />
                        </div>
                    ))}
                </div>

                <br/><Divider/>

                <ListItem
                    primaryText="Материалы"
                />
                <div className="row">
                    {filter.material && filter.material.material.length && filter.material.material.map((material, index) => (
                        <div className="col-md-6 filter__item" key={index}>
                            <Checkbox
                                label={material.material}
                                checked={material.check}
                                onCheck={checkFilter.bind(null, "material", material.material)}
                            />
                        </div>
                    ))}
                </div>

                <br/><Divider/>

                <ListItem
                    primaryText="Цена"
                />
                <div className="row">
                    {filter.size && filter.size.size &&
                    <div className="col-md-12 filter__item filter__item_range">
                        <InputRange
                            maxValue={price.max}
                            minValue={price.min}
                            value={filter.price.price}
                            formatLabel={value => `${value} Грн`}
                            onChange={value => changePrice(value)} />
                    </div>
                    }
                </div>

            </List>
        </aside>
    );
};