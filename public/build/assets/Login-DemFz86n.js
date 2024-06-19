import{h as y,i as v,v as k,o as d,f as x,T as V,c as f,w as l,a as t,u as s,Z as B,t as C,g as p,b as a,j as g,d as u,n as $,e as P}from"./app-DGqO5pHc.js";import{_ as U}from"./GuestLayout-CeIU3OK-.js";import{_ as h,a as b,b as w}from"./TextInput-PmmaxB_m.js";import{P as j}from"./PrimaryButton-BPwliUoF.js";import"./ApplicationLogo-BKrxjtdN.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const q=["value"],N={__name:"Checkbox",props:{checked:{type:[Array,Boolean],required:!0},value:{default:null}},emits:["update:checked"],setup(n,{emit:e}){const m=e,i=n,o=y({get(){return i.checked},set(r){m("update:checked",r)}});return(r,c)=>v((d(),x("input",{type:"checkbox",value:n.value,"onUpdate:modelValue":c[0]||(c[0]=_=>o.value=_),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"},null,8,q)),[[k,o.value]])}},S={key:0,class:"mb-4 font-medium text-sm text-green-600"},L={class:"mt-4"},R={class:"block mt-4"},D={class:"flex items-center"},E=a("span",{class:"ms-2 text-sm text-gray-600"},"Remember me",-1),F={class:"flex items-center justify-end mt-4"},H={__name:"Login",props:{canResetPassword:{type:Boolean},status:{type:String}},setup(n){const e=V({email:"",password:"",remember:!1}),m=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(i,o)=>(d(),f(U,null,{default:l(()=>[t(s(B),{title:"Log in"}),n.status?(d(),x("div",S,C(n.status),1)):p("",!0),a("form",{onSubmit:P(m,["prevent"])},[a("div",null,[t(h,{for:"email",value:"Email"}),t(b,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[0]||(o[0]=r=>s(e).email=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(w,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),a("div",L,[t(h,{for:"password",value:"Password"}),t(b,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=r=>s(e).password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(w,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),a("div",R,[a("label",D,[t(N,{name:"remember",checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=r=>s(e).remember=r)},null,8,["checked"]),E])]),a("div",F,[n.canResetPassword?(d(),f(s(g),{key:0,href:i.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:l(()=>[u(" Forgot your password? ")]),_:1},8,["href"])):p("",!0),t(s(g),{href:i.route("register"),class:"ms-4 inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"},{default:l(()=>[u(" Sign Up ")]),_:1},8,["href"]),t(j,{class:$(["ms-4 inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:l(()=>[u(" Log in ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{H as default};
