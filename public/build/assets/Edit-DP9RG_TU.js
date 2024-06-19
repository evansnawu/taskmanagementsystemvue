import{T as f,o as g,f as _,a as t,u as e,w as d,F as x,Z as b,b as a,e as h,i as k,A as w,d as c,j as v}from"./app-DGqO5pHc.js";import{_ as y}from"./AuthenticatedLayout-B02NBp87.js";import{_ as r,a as p,b as n}from"./TextInput-PmmaxB_m.js";import{P as V}from"./PrimaryButton-BPwliUoF.js";import{_ as T}from"./SelectInput-w0E4j2QO.js";import"./ApplicationLogo-BKrxjtdN.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const U=a("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Update Task ",-1),$={class:"my-3 max-w-7xl sm:mx-auto sm:px-6 lg:px-8 space-y-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 py-12"},B={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},D={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},j=a("div",null,[a("h3",{class:"text-lg leading-6 font-medium text-gray-900 pl-6"}," Task Information "),a("p",{class:"mt-1 text-sm text-gray-500 pl-6"}," Use this form to edit a new task. ")],-1),N={class:"mb-4"},P={class:"mb-4"},q={class:"mb-4"},A={class:"mb-4"},C={class:"flex items-center gap-4"},z={__name:"Edit",props:{status:{type:Array},task:{type:Object}},setup(u){const i=u,s=f({title:i.task.title,duedate:i.task.duedate,status:i.task.status,description:i.task.description});return(m,o)=>(g(),_(x,null,[t(e(b),{title:"Update Task"}),t(y,null,{header:d(()=>[U]),default:d(()=>[a("div",$,[a("div",B,[a("div",D,[j,a("form",{onSubmit:o[4]||(o[4]=h(l=>e(s).put(m.route("tasks.update",i.task)),["prevent"])),class:"grid grid-cols-1 lg:grid-cols-2 gap-4 p-6"},[a("div",N,[t(r,{for:"title",value:"Title"}),t(p,{id:"title",type:"text",class:"mt-1 block w-full",modelValue:e(s).title,"onUpdate:modelValue":o[0]||(o[0]=l=>e(s).title=l),required:"",autofocus:"",autocomplete:"title"},null,8,["modelValue"]),t(n,{class:"mt-2",message:e(s).errors.title},null,8,["message"])]),a("div",P,[t(r,{for:"duedate",value:"Due Date"}),t(p,{id:"duedate",type:"date",class:"mt-1 block w-full",modelValue:e(s).duedate,"onUpdate:modelValue":o[1]||(o[1]=l=>e(s).duedate=l),required:"",autofocus:"",autocomplete:"duedate"},null,8,["modelValue"]),t(n,{class:"mt-2",message:e(s).errors.duedate},null,8,["message"])]),a("div",q,[t(r,{for:"status",value:"Status"}),t(T,{class:"mt-1 block w-full",modelValue:e(s).status,"onUpdate:modelValue":o[2]||(o[2]=l=>e(s).status=l),options:u.status,"option-value":"id","option-label":"name","default-option":{id:"",name:"Please select"}},null,8,["modelValue","options"]),t(n,{class:"mt-2",message:e(s).errors.status},null,8,["message"])]),a("div",A,[t(r,{for:"description",value:"Description"}),k(a("textarea",{"onUpdate:modelValue":o[3]||(o[3]=l=>e(s).description=l),id:"description",class:"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,512),[[w,e(s).description]]),t(n,{class:"mt-2",message:e(s).errors.description},null,8,["message"])]),a("div",C,[t(V,{processing:e(s).processing},{default:d(()=>[c("Update Task")]),_:1},8,["processing"]),t(e(v),{href:m.route("tasks.index"),class:"inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"},{default:d(()=>[c(" Cancel ")]),_:1},8,["href"])])],32)])])])]),_:1})],64))}};export{z as default};
