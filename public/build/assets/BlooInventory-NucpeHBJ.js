import{p as f,T as B,o as d,c as n,a as h,u as r,Z as b,m as g,b as t,F as k,r as w,t as e,d as _,w as x,e as C,v as S,k as E,q as N}from"./app-MHH2OR-o.js";const V={id:"mainbody"},$={class:"main-body"},A={class:"tabs",id:"tabls"},H={class:"str"},L=E('<div class="str-home"><i class="fa fa-home"></i><div class="db"><h4>Dashboard /  </h4><p>Blood inventory</p></div></div><div class="full-chart"><div class="chart-title flex-class"><div class="circle-success"><i class="fa fa-check-circle"></i></div><div class="circle-text"><p>Your can burking a blood from other hospitals</p></div></div></div>',2),M={class:"table-st",id:"bloodBanks"},T={class:"table-st-head"},D=t("h4",null,"Blood Bank",-1),q={class:"input-seach"},F={class:"table-body"},Y={class:"student-data"},G=t("tr",{class:"border"},[t("th",null,"#"),t("th",null,"Hospital name"),t("th",null,"Hospital city"),t("th",null,"Hospital lga"),t("th",null,"Blood number"),t("th",null,"Blood group"),t("th",null,"Blood component"),t("th",null,"Quantity"),t("th",null,"Collection date"),t("th",null,"Expiry date"),t("th",null,"Blood status"),t("th",null,"Action")],-1),K={key:0,class:"status-approved"},P=["onClick"],Q=t("i",{class:"fa fa-plus-circle view"},null,-1),U=[Q],Z=["id"],j={class:"modal-dialog"},z=t("div",{class:"modal-head"},[t("p",null,"Burking Blood")],-1),J=["onSubmit"],O={class:"form-body"},R={class:"form-group"},W=t("div",{class:"modal-footer"},[t("button",null,"Save"),t("button",{class:"delete",type:"button"},"Close")],-1),I={__name:"BlooInventory",props:{bloodInventory:Array},setup(m){const i=f(),p=o=>{if(o){let l=document.getElementById(""+o);l.style.display="flex"}},c=B({comment:""}),y=function(o,l){o&&N.post("/buy-need-blood/"+o+"/"+l,c).then(s=>{s.data.status==200?(i.success("Your have been burking this blood"),location.reload()):(console.log(s),i.error("Somthing went wrong"))}).catch(s=>{s.response&&s.response.status===422&&i.error("Please write the comment why need blood")})},v=o=>{{let l=document.getElementById("searchBarBlood").value;l=l.toLowerCase();let s=document.getElementsByClassName("rowBlood");for(let a=0;a<s.length;a++)s[a].innerHTML.toLowerCase().includes(l)?s[a].style.display="":s[a].style.display="none"}};return window.onclick=function(o){let l=document.getElementsByClassName("modal-burking");for(let s=0;s<l.length;s++)o.target==l[s]&&(l[s].style.display="none")},(o,l)=>(d(),n("div",null,[h(r(b),{title:"Apply"}),h(g),t("section",V,[t("div",$,[t("div",A,[t("div",H,[L,t("div",M,[t("div",T,[D,t("div",q,[t("input",{type:"text",placeholder:"Search",onKeyup:l[0]||(l[0]=s=>v()),id:"searchBarBlood"},null,32)])]),t("div",F,[t("table",Y,[G,(d(!0),n(k,null,w(m.bloodInventory,(s,a)=>(d(),n("tr",{class:"searchtab rowBlood",key:s.id},[t("td",null,e(a+1),1),t("td",null,e(s.hospital_name),1),t("td",null,e(s.hospital_city),1),t("td",null,e(s.hospital_lga),1),t("td",null,e("BG/"+s.id),1),t("td",null,e(s.blood_group),1),t("td",null,e(s.blood_component),1),t("td",null,e(s.quantity),1),t("td",null,e(s.collection_date),1),t("td",null,e(s.expiry_date),1),t("td",null,[s.is_active==1?(d(),n("div",K," Availabe ")):_("",!0)]),t("td",null,[o.$page.props.auth.user.role==4?(d(),n("a",{key:0,href:"#!",onClick:u=>p(s.id)},U,8,P)):_("",!0)]),t("div",{class:"modal-burking modal d-none",id:s.id},[t("div",j,[z,t("form",{class:"modal-body",onSubmit:x(u=>y(s.hospital_id,s.invent_id),["prevent"])},[t("div",O,[t("div",R,[C(t("textarea",{name:"","onUpdate:modelValue":l[1]||(l[1]=u=>r(c).comment=u)},e(s.id),513),[[S,r(c).comment]])])]),W],40,J)])],8,Z)]))),128))])])])])])])])]))}};export{I as default};