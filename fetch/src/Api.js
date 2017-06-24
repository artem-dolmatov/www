import React, { Component } from 'react';

const endpoint = 'http://bonus-get.ru/api/v1/offers';


let Offer = function(props) {
    return(
        <div>
            <div>{props.name}</div>
            <div>{props.user} {props.user2}</div>
        </div>
    )
}

class Api extends Component{

    state = {offers: []}

    componentDidMount(){
        fetch(endpoint)
            .then(blob => blob.json())
            .then(results => this.setState({offers: results.data}));
    }

    render(){
        return(
            <div>
                {this.state.offers.map(offer => {
                    return (
                        <Offer 
                        name={offer.name} 
                        user={offer.addresses[0].street} 
                        user2={offer.addresses[0].house} 
                        key={offer.name}
                        />
                    )    
                })}
            </div>    
        )
    }
}

export default Api;