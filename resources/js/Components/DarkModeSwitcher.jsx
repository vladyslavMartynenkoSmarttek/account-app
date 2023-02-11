import React from 'react'
export default function DarkModeSwitcher() {
//export DarkModeSwitcher
    const [darkToggle, setDarkToggle] = React.useState(false)
    return <label className="toggleDarkBtn">
        <input type="checkbox" onClick={() => setDarkToggle(!darkToggle)}/>
        <span className="slideBtnTg round"></span>
    </label>;
}
