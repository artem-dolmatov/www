import React, { Component } from 'react';
import './App.css';

let User = function(props) {
  return(
    <div>{props.name}</div>
  )
}

class App extends Component{

  state = {users: []}

  componentDidMount() {
    fetch('api/v1/offers')
      .then(res => res.json())
      .then(results => this.setState({ users: results.data}));
  }

  render(){
    return(
      <div className="App">
        {this.state.users.map(user => {
          return <User name={user.name} key={user.id} />
        })}
      </div>  
    );
  }

}

export default App;
