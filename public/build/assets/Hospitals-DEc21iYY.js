import{p,o as i,c as n,a as o,u,Z as v,m,b as t,F as f,r as y,t as s,d as b,h as C,j as k,k as H}from"./app-C_c4iFjf.js";const g={id:"mainbody"},A={class:"main-body"},B={class:"tabs",id:"tabls"},x={class:"str"},S=H('<div class="str-home"><i class="fa fa-home"></i><div class="db"><h4>Dashboard /  </h4><p>Hospital records</p></div></div><div class="full-chart"><div class="chart-title flex-class"><div class="circle-success"><i class="fa fa-check-circle"></i></div><div class="circle-text"><p>Your can find other hospital to burking a blood</p></div></div></div>',2),w={class:"table-st"},L={class:"table-st-head"},N=t("h4",null,"Hospital Records",-1),$={class:"table-body"},V={class:"student-data"},D=t("tr",{class:"border"},[t("th",null,"#"),t("th",null,"Applyer name"),t("th",null,"Applyer email"),t("th",null,"Hospital name"),t("th",null,"Hospital moto"),t("th",null,"Hospital city"),t("th",null,"Hospital lga"),t("th",null,"Hospital Location"),t("th",null,"Hospital email"),t("th",null,"Hospital GSM"),t("th",null,"CSC Certificate"),t("th",null,"App status"),t("th",null,"Action")],-1),E=["href"],M=["onClick"],j=["onClick"],F=["onClick"],T=t("i",{class:"fa fa-eye view"},null,-1),I={__name:"Hospitals",props:{hospotals:Array},setup(_){p();const c=d=>{},h=d=>{{let a=document.getElementById("searchBar").value;a=a.toLowerCase();let e=document.getElementsByClassName("searchtab");for(let l=0;l<e.length;l++)e[l].innerHTML.toLowerCase().includes(a)?e[l].style.display="":e[l].style.display="none"}};return(d,a)=>(i(),n("div",null,[o(u(v),{title:"Apply"}),o(m),t("section",g,[t("div",A,[t("div",B,[t("div",x,[S,t("div",w,[t("div",L,[N,t("input",{type:"text",placeholder:"Search",onKeyup:a[0]||(a[0]=e=>h()),id:"searchBar"},null,32)]),t("div",$,[t("table",V,[D,(i(!0),n(f,null,y(_.hospotals,(e,l)=>(i(),n("tr",{class:"searchtab",key:e.id},[t("td",null,s(l+1),1),t("td",null,s(e.user_name),1),t("td",null,s(e.email),1),t("td",null,s(e.hostpital_name),1),t("td",null,s(e.moto_name),1),t("td",null,s(e.state),1),t("td",null,s(e.lga_names),1),t("td",null,s(e.hospital_address),1),t("td",null,s(e.hospital_email),1),t("td",null,s(e.hospital_phone),1),t("td",null,[t("a",{href:e.csc_certificate},"CSC certificate",8,E)]),t("td",null,[e.is_active==1?(i(),n("div",{key:0,class:"status",onClick:r=>c(e.id)}," Pendding ",8,M)):e.is_active==2?(i(),n("div",{key:1,class:"status-approved",onClick:r=>c(e.id)}," Approved ",8,j)):e.is_active==3?(i(),n("div",{key:2,class:"status-reject",onClick:r=>c(e.id)}," Decline ",8,F)):b("",!0)]),t("td",null,[o(u(k),{href:d.route("hospitals.show",e.hospital_id)},{default:C(()=>[T]),_:2},1032,["href"])])]))),128))])])])])])])])]))}};export{I as default};