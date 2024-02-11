(function(){if(document.getElementById("tblTelcelCanales")){var a=$("#tblTelcelCanales").data("url");const n=$("#tblTelcelCanales").DataTable({dom:"Brtip",buttons:["copy","excel","print"],pageLength:10,ajax:{url:a,dataSrc:""},scrollX:!0,columns:[{data:"nombre"},{data:"clave",render:function(e,s,t){return`<span class="badge border bg-light text-default custom-badge px-2">${t.clave}</span>`}},{data:"acox"},{data:"concepto.concepto"},{data:"sucursal.nombre"},{data:"sucursal.empleados",render:function(e,s,t){return e.length}},{data:null,render:function(e,s,t){return`
                        <div class="btn-group btn-group-sm">
                            <a class="modal-effect btn btn-sm btn-outline-${t.question==1?"success":"warning"} waves-effect waves-light"
                                data-bs-effect="effect-slide-in-right" 
                                data-bs-toggle="modal" 
                                href="#modalCanales" 
                                data-url="${t.ruta_editar}"
                                data-title="Editar canal"
                                data-param="${t.id}"
                            >
                                <i class="bi bi-gear"></i>
                            </a>
               
                        </div>
                        `}}],columnDefs:[{targets:3,className:"text-center",render:function(e,s,t,l){let o=t.concepto.concepto==="Distribuidor"?"primary":t.concepto.concepto==="Subs"?"success":"warning";return o=t.id==1?"danger":o,`
                        <span class="badge bg-${o}-transparent" />
                            ${t.concepto.concepto}
                        </span>
                        `}}]});c(n,"src_telcel_canal","btnTelcelCanales")}})();function c(a,n,e){$("thead",a).addClass("text-info"),$(".pagination",a).addClass("my-2"),Array.from(a.buttons().nodes()).forEach(t=>{t.classList.remove("btn-secondary"),t.classList.add("btn-sm","btn-outline-info","btn-wave","waves-effect","waves-light")}),a.buttons().container().appendTo("#"+e),$("#"+n).val("").on("keyup",function(){a.search(this.value).draw()})}function r(a){let n="";switch(a){case"Suspendido":n="warning";break;case"Baja":n="danger";break;default:n="success";break}return n}if(document.getElementById("tblEmpleados")){const a=$("#tblEmpleados").DataTable({dom:"Brtip",buttons:["copy","excel","print"],pageLength:10,resposive:!0,columnDefs:[{targets:3,render:function(e,s,t,l){return`
                    <span class="badge bg-${r(t[3])}-transparent" />
                        ${t[3]}
                    </span>
                    `}}]});Array.from(a.buttons().nodes()).forEach(e=>{e.classList.remove("btn-secondary"),e.classList.add("btn-sm","btn-outline-info","btn-wave","waves-effect","waves-light")}),$("thead",a.table).addClass("text-info"),$(".pagination",a.table).addClass("my-2"),a.buttons().container().appendTo("#tblEmpleadosBtn"),$("#tblEmpleadosInput").on("keyup",function(){a.search(this.value).draw()})}
