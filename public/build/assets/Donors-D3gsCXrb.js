import{p as f,T as b,o,c as n,a as h,u,Z as g,m as k,b as e,t as i,F as C,r as S,d as r,w as B,e as D,x as V,q as $}from"./app-Bev9O1Bh.js";const x={id:"mainbody"},w={class:"main-body"},A={class:"tabs",id:"tabls"},E={class:"str"},M=e("div",{class:"str-home"},[e("i",{class:"fa fa-home"}),e("div",{class:"db"},[e("h4",null,"Dashboard /  "),e("p",null,"Donors records")])],-1),L={class:"full-chart"},N={class:"chart-title flex-class"},H=e("div",{class:"circle-success"},[e("i",{class:"fa fa-check-circle"})],-1),I={class:"circle-text"},j={class:"table-st"},F={class:"table-st-head"},P=e("h4",null,"Donors Records",-1),T={class:"table-body"},R={class:"student-data"},U=e("tr",{class:"border"},[e("th",null,"#"),e("th",null,"Full name"),e("th",null,"Email"),e("th",null,"GSM"),e("th",null,"Sex"),e("th",null,"Blood group"),e("th",null,"Hiv test"),e("th",null,"State"),e("th",null,"Lga"),e("th",null,"Home address"),e("th",null,"Why app"),e("th",null,"App status")],-1),q={key:0},G=["onClick"],K=["onClick"],W=["onClick"],Y={key:1},Z={key:0,class:"status"},z={key:1,class:"status-approved"},J={key:2,class:"status-reject"},O=["id"],Q={class:"modal-dialog"},X=e("div",{class:"modal-head"},[e("p",null,"Approve | Reject")],-1),ee=["onSubmit"],se={class:"form-body"},te={class:"form-group"},le=e("option",{value:"",hidden:""},"Change status",-1),ae=e("option",{value:1},"Pendding",-1),ie=e("option",{value:2},"Approved",-1),oe=e("option",{value:3},"Decline",-1),ne=[le,ae,ie,oe],de={class:"modal-footer"},ce=e("button",null,"Save",-1),ue=["onClick"],_e=["value","id"],re={__name:"Donors",props:{donors:Array},setup(p){const _=f(),d=l=>{if(l){let t=document.getElementById(""+l);t.style.display="flex"}},v=l=>{if(l){let t=document.getElementById(""+l);t.style.display="none"}},c=b({selectVal:""}),m=function(l){if(l){const t=document.getElementById("select"+l).value;$.post("/update-status/"+t,c).then(s=>{s.data.status==200?(_.success("Updated status sucessfully"),location.reload()):(console.log(s),_.error("Somthing went wrong"))})}},y=l=>{{let t=document.getElementById("searchBar").value;t=t.toLowerCase();let s=document.getElementsByClassName("searchtab");for(let a=0;a<s.length;a++)s[a].innerHTML.toLowerCase().includes(t)?s[a].style.display="":s[a].style.display="none"}};return(l,t)=>(o(),n("div",null,[h(u(g),{title:"Apply"}),h(k),e("section",x,[e("div",w,[e("div",A,[e("div",E,[M,e("div",L,[e("div",N,[H,e("div",I,[e("p",null,"Hi, "+i(l.$page.props.auth.user.name)+" Your Verify Donors",1)])])]),e("div",j,[e("div",F,[P,e("input",{type:"text",placeholder:"Search",onKeyup:t[0]||(t[0]=s=>y()),id:"searchBar"},null,32)]),e("div",T,[e("table",R,[U,(o(!0),n(C,null,S(p.donors,s=>(o(),n("tr",{class:"searchtab",key:s.id},[e("td",null,i(s.id),1),e("td",null,i(s.user_name),1),e("td",null,i(s.email),1),e("td",null,i(s.phone_number),1),e("td",null,i(s.gender),1),e("td",null,i(s.blood_group),1),e("td",null,i(s.hiv_test),1),e("td",null,i(s.state),1),e("td",null,i(s.lga_names),1),e("td",null,i(s.home_address),1),e("td",null,i(s.reason),1),e("td",null,[l.$page.props.auth.user.role==1?(o(),n("div",q,[s.is_active==1?(o(),n("div",{key:0,class:"status",onClick:a=>d(s.id)}," Pendding ",8,G)):s.is_active==2?(o(),n("div",{key:1,class:"status-approved",onClick:a=>d(s.id)}," Approved ",8,K)):s.is_active==3?(o(),n("div",{key:2,class:"status-reject",onClick:a=>d(s.id)}," Decline ",8,W)):r("",!0)])):(o(),n("div",Y,[s.is_active==1?(o(),n("div",Z," Pendding ")):s.is_active==2?(o(),n("div",z," Approved ")):s.is_active==3?(o(),n("div",J," Decline ")):r("",!0)]))]),e("div",{class:"modal d-none",id:s.id},[e("div",Q,[X,e("form",{class:"modal-body",onSubmit:B(a=>m(s.user_id_none),["prevent"])},[e("div",se,[e("div",te,[D(e("select",{id:"selectValue","onUpdate:modelValue":t[1]||(t[1]=a=>u(c).selectVal=a)},ne,512),[[V,u(c).selectVal]])])]),e("div",de,[ce,e("button",{class:"delete",type:"button",onClick:a=>v(s.id)},"Close",8,ue)])],40,ee),e("input",{type:"hidden",value:s.user_id,id:s.selectName+s.user_id_none},null,8,_e)])],8,O)]))),128))])])])])])])])]))}};export{re as default};
