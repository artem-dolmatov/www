import React from 'react';
import ReactDOM from 'react-dom';
import registerServiceWorker from './registerServiceWorker';
import './index.css';

// import App from './App';
import Api from './Api'

ReactDOM.render(
    <Api />, 
    document.getElementById('root'));
    registerServiceWorker();
