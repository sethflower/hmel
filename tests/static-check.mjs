import fs from 'node:fs';import path from 'node:path';
const files=[];for(const root of ['frontend','api']){const walk=d=>{for(const e of fs.readdirSync(d,{withFileTypes:true})){const p=path.join(d,e.name);e.isDirectory()?walk(p):files.push(p)}};walk(root)}
for(const f of files){const s=fs.readFileSync(f,'utf8');if(/\bTODO\b|implement later|\bmock\b|\bdemo\b/i.test(s))throw new Error(`Forbidden marker in ${f}`)}
const schema=fs.readFileSync('api/install/schema.sql','utf8');for(const table of ['users','sessions','vehicles','deliveries','prns','prn_items','pallets','pallet_items','cells','stock','placements','audit_log','settings'])if(!schema.includes(` ${table} `))throw new Error('Missing table '+table);
if(/google sheets|apps script/i.test([...files].filter(x=>x!=='README.md').map(x=>fs.readFileSync(x,'utf8')).join('\n')))throw new Error('Legacy Google integration found');
console.log(`Static checks passed for ${files.length} files`);
