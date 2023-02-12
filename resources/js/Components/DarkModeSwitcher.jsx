import {DarkModeSwitch} from "react-toggle-dark-mode";
import * as React from 'react';
import * as ReactDOM from 'react-dom';
export default function DarkModeSwitcher() {
//export DarkModeSwitcher
    const [isDarkMode, setIsDarkMode] = React.useState(false);

    const toggleDarkMode = (checked) => {
        if (checked){
            document.documentElement.classList.add('dark');
            //set attr data-mode
            document.documentElement.setAttribute('data-mode', 'dark');
            //set body data-mode
            document.body.setAttribute('data-mode', 'dark');
        }else {
            document.documentElement.classList.remove('dark');
            //remove attr data-mode
            document.documentElement.removeAttribute('data-mode');
            //remove body data-mode
            document.body.removeAttribute('data-mode');
        }

        //check isset localstorage darkmode
        if (localStorage.getItem('theme') === null) {
            localStorage.setItem('theme', 'light');
        }
        //set localstorage darkmode
        localStorage.setItem('theme', checked ? 'dark' : 'light');
        //set state darkmode
        setIsDarkMode(checked);
    }

    return<DarkModeSwitch
        style={{ marginBottom: '2rem' }}
        checked={isDarkMode}
        onChange={toggleDarkMode}
        size={30}
    />;
}
