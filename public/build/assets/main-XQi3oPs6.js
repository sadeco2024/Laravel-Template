(function(){var o;localStorage.getItem("udondarktheme")&&(document.querySelector("html").setAttribute("data-theme-mode","dark"),document.querySelector("html").setAttribute("data-menu-styles","dark"),document.querySelector("html").setAttribute("data-header-styles","dark")),localStorage.udonrtl&&(document.querySelector("html").setAttribute("dir","rtl"),(o=document.querySelector("#style"))==null||o.setAttribute("href","../assets/libs/bootstrap/css/bootstrap.rtl.min.css")),localStorage.udonlayout&&(document.querySelector("html").setAttribute("data-nav-layout","horizontal"),document.querySelector("html").setAttribute("data-menu-styles","light")),localStorage.getItem("udonlayout")=="horizontal"&&document.querySelector("html").setAttribute("data-nav-layout","horizontal"),localStorage.loaderEnable=="true"?document.querySelector("html").setAttribute("loader","enable"):document.querySelector("html").getAttribute("loader")||document.querySelector("html").setAttribute("loader","disable");function a(){if(localStorage.primaryRGB&&(document.querySelector(".theme-container-primary")&&(document.querySelector(".theme-container-primary").value=localStorage.primaryRGB),document.querySelector("html").style.setProperty("--primary-rgb",localStorage.primaryRGB)),localStorage.bodyBgRGB&&localStorage.bodylightRGB){document.querySelector(".theme-container-background")&&(document.querySelector(".theme-container-background").value=localStorage.bodyBgRGB),document.querySelector("html").style.setProperty("--body-bg-rgb",localStorage.bodyBgRGB),document.querySelector("html").style.setProperty("--body-bg-rgb2",localStorage.bodylightRGB),document.querySelector("html").style.setProperty("--light-rgb",localStorage.bodylightRGB),document.querySelector("html").style.setProperty("--form-control-bg",`rgb(${localStorage.bodylightRGB})`),document.querySelector("html").style.setProperty("--input-border","rgba(255,255,255,0.1)");let e=document.querySelector("html");e.setAttribute("data-theme-mode","dark"),e.setAttribute("data-menu-styles","dark"),e.setAttribute("data-header-styles","dark")}if(localStorage.udondarktheme&&document.querySelector("html").setAttribute("data-theme-mode","dark"),localStorage.udonlayout){let e=document.querySelector("html");localStorage.getItem("udonlayout"),e.setAttribute("data-nav-layout","horizontal"),setTimeout(()=>{clearNavDropdown()},5e3),e.setAttribute("data-nav-style","menu-click"),setTimeout(()=>{checkHoriMenu()},5e3)}if(localStorage.udonverticalstyles){let e=document.querySelector("html"),l=localStorage.getItem("udonverticalstyles");l=="default"&&(e.setAttribute("data-vertical-style","default"),localStorage.removeItem("udonnavstyles")),l=="closed"&&(e.setAttribute("data-vertical-style","closed"),localStorage.removeItem("udonnavstyles")),l=="icontext"&&(e.setAttribute("data-vertical-style","icontext"),localStorage.removeItem("udonnavstyles")),l=="overlay"&&(e.setAttribute("data-vertical-style","overlay"),localStorage.removeItem("udonnavstyles")),l=="detached"&&(e.setAttribute("data-vertical-style","detached"),localStorage.removeItem("udonnavstyles")),l=="doublemenu"&&(e.setAttribute("data-vertical-style","doublemenu"),localStorage.removeItem("udonnavstyles"),setTimeout(()=>{const u=document.querySelectorAll(".main-menu > li > .side-menu__item"),t=document.createElement("div");t.className="custome-tooltip",t.style.setProperty("position","fixed"),t.style.setProperty("display","none"),t.style.setProperty("padding","0.5rem"),t.style.setProperty("font-weight","500"),t.style.setProperty("font-size","0.75rem"),t.style.setProperty("background-color","rgb(15, 23 ,42)"),t.style.setProperty("color","rgb(255, 255 ,255)"),t.style.setProperty("margin-inline-start","48px"),t.style.setProperty("border-radius","0.25rem"),t.style.setProperty("z-index","99"),u.forEach(r=>{r.addEventListener("mouseenter",()=>{localStorage.udonverticalstyles=="doublemenu"&&(t.style.setProperty("display","block"),t.textContent=r.querySelector(".side-menu__label").textContent,document.querySelector("html").getAttribute("data-vertical-style")=="doublemenu"&&r.appendChild(t))}),r.addEventListener("mouseleave",()=>{t.style.setProperty("display","none"),t.textContent=r.querySelector(".side-menu__label").textContent})})},1e3))}if(localStorage.udonnavstyles){let e=document.querySelector("html"),l=localStorage.getItem("udonnavstyles");l=="menu-click"&&(e.setAttribute("data-nav-style","menu-click"),localStorage.removeItem("udonverticalstyles"),e.removeAttribute("data-vertical-style")),l=="menu-hover"&&(e.setAttribute("data-nav-style","menu-hover"),localStorage.removeItem("udonverticalstyles"),e.removeAttribute("data-vertical-style")),l=="icon-click"&&(e.setAttribute("data-nav-style","icon-click"),localStorage.removeItem("udonverticalstyles"),e.removeAttribute("data-vertical-style")),l=="icon-hover"&&(e.setAttribute("data-nav-style","icon-hover"),localStorage.removeItem("udonverticalstyles"),e.removeAttribute("data-vertical-style"))}if(localStorage.udonclassic&&document.querySelector("html").setAttribute("data-page-style","classic"),localStorage.udonmodern&&document.querySelector("html").setAttribute("data-page-style","modern"),localStorage.udonboxed&&document.querySelector("html").setAttribute("data-width","boxed"),localStorage.udonheaderfixed&&document.querySelector("html").setAttribute("data-header-position","fixed"),localStorage.udonheaderscrollable&&document.querySelector("html").setAttribute("data-header-position","scrollable"),localStorage.udonmenufixed&&document.querySelector("html").setAttribute("data-menu-position","fixed"),localStorage.udonmenuscrollable&&document.querySelector("html").setAttribute("data-menu-position","scrollable"),localStorage.udonMenu){let e=document.querySelector("html");switch(localStorage.getItem("udonMenu")){case"light":e.setAttribute("data-menu-styles","light");break;case"dark":e.setAttribute("data-menu-styles","dark");break;case"color":e.setAttribute("data-menu-styles","color");break;case"gradient":e.setAttribute("data-menu-styles","gradient");break;case"transparent":e.setAttribute("data-menu-styles","transparent");break}}if(localStorage.udonHeader){let e=document.querySelector("html");switch(localStorage.getItem("udonHeader")){case"light":e.setAttribute("data-header-styles","light");break;case"dark":e.setAttribute("data-header-styles","dark");break;case"color":e.setAttribute("data-header-styles","color");break;case"gradient":e.setAttribute("data-header-styles","gradient");break;case"transparent":e.setAttribute("data-header-styles","transparent");break}}if(localStorage.bgimg){let e=document.querySelector("html"),l=localStorage.getItem("bgimg");e.setAttribute("data-bg-img",l)}}a()})();
