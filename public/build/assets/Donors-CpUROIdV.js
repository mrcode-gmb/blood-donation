import{p as y,T as f,o as i,f as o,a as h,u,Z as b,m as g,b as s,t as l,F as k,q as C,g as r,e as S,h as B,y as D,s as V}from"./app-qwW2-e7L.js";const $={id:"mainbody"},x={class:"main-body"},A={class:"tabs",id:"tabls"},w={class:"str"},E=s("div",{class:"str-home"},[s("i",{class:"fa fa-home"}),s("div",{class:"db"},[s("h4",null,"Dashboard /  "),s("p",null,"Donors records")])],-1),L={class:"full-chart"},M={class:"chart-title flex-class"},N=s("div",{class:"circle-success"},[s("i",{class:"fa fa-check-circle"})],-1),H={class:"circle-text"},j={class:"table-st"},F={class:"table-st-head"},I=s("h4",null,"Donors Records",-1),P={class:"table-body"},T={class:"student-data"},R=s("tr",{class:"border"},[s("th",null,"#"),s("th",null,"Full name"),s("th",null,"Email"),s("th",null,"GSM"),s("th",null,"Sex"),s("th",null,"Blood group"),s("th",null,"Hiv test"),s("th",null,"State"),s("th",null,"Lga"),s("th",null,"Home address"),s("th",null,"Why app"),s("th",null,"App status")],-1),U={key:0},q=["onClick"],G=["onClick"],K=["onClick"],W={key:1},Y={key:0,class:"status"},Z={key:1,class:"status-approved"},z={key:2,class:"status-reject"},J=["id"],O={class:"modal-dialog"},Q=s("div",{class:"modal-head"},[s("p",null,"Approve | Reject")],-1),X=["onSubmit"],ss={class:"form-body"},es={class:"form-group"},ts=s("option",{value:"",hidden:""},"Change status",-1),ls=s("option",{value:1},"Pendding",-1),as=s("option",{value:2},"Approved",-1),is=s("option",{value:3},"Decline",-1),os=[ts,ls,as,is],ns=s("div",{class:"modal-footer"},[s("button",null,"Save"),s("button",{class:"delete",type:"button"},"Close")],-1),ds=["value","id"],us={__name:"Donors",props:{donors:Array},setup(p){const _=y(),d=n=>{if(n){let t=document.getElementById(""+n);t.style.display="flex"}},c=f({selectVal:""}),v=function(n){if(n){const t=document.getElementById("select"+n).value;V.post("/update-status/"+t,c).then(e=>{e.data.status==200?(_.success("Updated status sucessfully"),location.reload()):(console.log(e),_.error("Somthing went wrong"))})}},m=n=>{{let t=document.getElementById("searchBar").value;t=t.toLowerCase();let e=document.getElementsByClassName("searchtab");for(let a=0;a<e.length;a++)e[a].innerHTML.toLowerCase().includes(t)?e[a].style.display="":e[a].style.display="none"}};return(n,t)=>(i(),o("div",null,[h(u(b),{title:"Apply"}),h(g),s("section",$,[s("div",x,[s("div",A,[s("div",w,[E,s("div",L,[s("div",M,[N,s("div",H,[s("p",null,"Hi, "+l(n.$page.props.auth.user.name)+" Your Verify Donors",1)])])]),s("div",j,[s("div",F,[I,s("input",{type:"text",placeholder:"Search",onKeyup:t[0]||(t[0]=e=>m()),id:"searchBar"},null,32)]),s("div",P,[s("table",T,[R,(i(!0),o(k,null,C(p.donors,e=>(i(),o("tr",{class:"searchtab",key:e.id},[s("td",null,l(e.id),1),s("td",null,l(e.user_name),1),s("td",null,l(e.email),1),s("td",null,l(e.phone_number),1),s("td",null,l(e.gender),1),s("td",null,l(e.blood_group),1),s("td",null,l(e.hiv_test),1),s("td",null,l(e.state),1),s("td",null,l(e.lga_names),1),s("td",null,l(e.home_address),1),s("td",null,l(e.reason),1),s("td",null,[n.$page.props.auth.user.role==1?(i(),o("div",U,[e.is_active==1?(i(),o("div",{key:0,class:"status",onClick:a=>d(e.id)}," Pendding ",8,q)):e.is_active==2?(i(),o("div",{key:1,class:"status-approved",onClick:a=>d(e.id)}," Approved ",8,G)):e.is_active==3?(i(),o("div",{key:2,class:"status-reject",onClick:a=>d(e.id)}," Decline ",8,K)):r("",!0)])):(i(),o("div",W,[e.is_active==1?(i(),o("div",Y," Pendding ")):e.is_active==2?(i(),o("div",Z," Approved ")):e.is_active==3?(i(),o("div",z," Decline ")):r("",!0)]))]),s("div",{class:"modal d-none",id:e.id},[s("div",O,[Q,s("form",{class:"modal-body",onSubmit:S(a=>v(e.user_id_none),["prevent"])},[s("div",ss,[s("div",es,[B(s("select",{id:"selectValue","onUpdate:modelValue":t[1]||(t[1]=a=>u(c).selectVal=a)},os,512),[[D,u(c).selectVal]])])]),ns],40,X),s("input",{type:"hidden",value:e.user_id,id:e.selectName+e.user_id_none},null,8,ds)])],8,J)]))),128))])])])])])])])]))}};export{us as default};