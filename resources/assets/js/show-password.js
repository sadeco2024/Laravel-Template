"use strict";

// for show password
let viewPassword = (type, ele) => {
    document.getElementById(type).type =
        document.getElementById(type).type == "password" ? "text" : "password";

    for (let i = 0; i < ele.childNodes.length; i++) {
        let icon = ele.childNodes[i].classList;
        let stringIcon = icon?.toString();
        
        if (stringIcon) 
        if (stringIcon.includes("ri-eye-line")) {
            ele.childNodes[i].classList.remove("ri-eye-line");
            ele.childNodes[i].classList.add("ri-eye-off-line");
        } else {
            ele.childNodes[i].classList.add("ri-eye-line");
            ele.childNodes[i].classList.remove("ri-eye-off-line");
        }
    }
    // console.log(icon)
    // let stringIcon = icon.toString()
    // if (stringIcon.includes("ri-eye-line")) {
    //     ele.childNodes[i].classList.remove("ri-eye-line")
    //     ele.childNodes[i].classList.add("ri-eye-off-line")
    // }
    // else {
    //     ele.childNodes[i].classList.add("ri-eye-line")
    //     ele.childNodes[i].classList.remove("ri-eye-off-line")
    // }
};
