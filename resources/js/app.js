import React from 'react';
import ReactDOM from 'react-dom';
import CrawlerApp from './CrawlerApp';

import './bootstrap'

if(document.getElementById('root') !== null) {
    ReactDOM.render(
        <React.StrictMode>
            <CrawlerApp />
        </React.StrictMode>,
        document.getElementById('root')
    );
}


