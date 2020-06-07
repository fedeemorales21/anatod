'use strict'

window.addEventListener('DOMContentLoaded', () => {
    getListClient()
    getProvinces('provinceUser')
    sendForm()
    saveEdit()
})

const API = './API'

const getProvinces = async (idSelectElement,idSelect = 0) => {
    try {
        const req = await fetch(`${API}/provinces/getProvinces.php`)
        const {data} = await req.json()
        let listProvinces = '<option value="0" disabled>Selecione Provincia</li>'
        data.forEach( prov => {
            listProvinces += `<option value="${prov.id}">${prov.name}</li>`
        });
        let element = document.getElementById(idSelectElement)
        element.innerHTML = listProvinces
        element.value = idSelect
        element.addEventListener('change', async e => {
            e.stopImmediatePropagation()
            getLocalities(idSelectElement,'localitiesUser')
        })
    } catch (error) {
        console.log(error)
    }
}


const getLocalities = async (idSelectElementProvinces,idSelectElementLocalities ,idSelect = 0) => {
    try {
        const id = document.getElementById(idSelectElementProvinces).value       
        const req = await fetch(`${API}/localities/getLocalities.php?id=${id}`)
        const {data} = await req.json()
        let listLocalities = '<option value="0" disabled>Selecione Localidad</li>'
        data.forEach( prov => {
            listLocalities += `<option value="${prov.id}">${prov.name}</li>`
        });
        let element = document.getElementById(idSelectElementLocalities)
        element.innerHTML = listLocalities
        element.value = idSelect
     
    } catch (error) {
        console.log(error)
    }
}


const sendForm = () => {
    try {
        const btn = document.getElementById('saveClient')
        btn.addEventListener('click', async e => {
            e.preventDefault()
            e.stopImmediatePropagation()
            const form = document.getElementById('formUser')
            const data = new FormData(form)
            let ok = true
            
            for (let d of data.entries()){
              if ( d[1] == null || d[1] == undefined  ) {
                document.getElementById('err-'+ d[0]).style.display = 'block' 
                ok = false
              }
            }
            if (ok) {
              const req = await fetch(`${API}/clients/createClient.php`,{
                method:'POST',
                body:data
              })
              let {msg} = await req.json()
              form.reset()
              alert(msg)
              getListClient()
              cancelEdit()
            }
        
        })
    } catch (error) {
        console.log(error)
    }
}


const getListClient = async () => {
    try {
        const req = await fetch(`${API}/clients/getListsClients.php`)
        const res = await req.json()
        
        let listClientA = ''
        if (res.listA.length  > 0) {            
            res.listA.forEach(cli => {
                listClientA += `
                    <tr>
                        <td>${cli.id}</td>
                        <td>${cli.name}</td>
                        <td>${cli.dni}</td>
                        <td>${cli.locality}</td>
                        <td>${cli.province}</td>
                        <td>
                            <button type="button" class="btn btn-warning edtUser" data-id="${cli.id}">
                                <i class="fal fa-user-edit"></i>
                            </button>
                        </td>
                    </tr>                
                `
                document.getElementById('tableA').innerHTML = listClientA
                getClientPerID()
            });
        }else{
            listClientA = '<p>No hay registros<p>'
            document.getElementById('tableA').innerHTML = listClientA
        }
        
        
        let listClientB = ''
        if (res.listB.length  > 0) {            
            res.listB.forEach(cli => {
                listClientB += `
                    <tr>
                        <td>${cli.id}</td>
                        <td>${cli.name_province}</td>         
                        <td>${cli.name_locality}</td>
                        <td>${cli.number}</td>
                    </tr>                
                `
                document.getElementById('tableB').innerHTML = listClientB
            });
        }else{
            listClientB = '<p>No hay registros<p>'
            document.getElementById('tableB').innerHTML = listClientB
        }
        
        
    } catch (error) {
        console.log(error)
    }
}


const getClientPerID = () => {
    try {
        const btns = document.querySelectorAll('.edtUser')
        btns.forEach(btn => {
            btn.addEventListener('click', async e => {
                e.preventDefault()
                e.stopImmediatePropagation()

                const req = await fetch(`${API}/clients/getClientPerID.php?id=${btn.getAttribute('data-id')}`)
                const {success,data,msg} = await req.json()
                if (success) {
                    document.getElementById('idUser').value = data[0].id
                    document.getElementById('nameUser').value = data[0].name
                    document.getElementById('dniUser').value = data[0].dni
                    document.getElementById('provinceUser').value = data[0].provinces_id
                    getLocalities('provinceUser','localitiesUser',data[0].localities_id)

                    const btnSave =  document.getElementById('saveClient'),
                    btnSaveEdit = document.getElementById('saveEdit'),
                    btnCancelEdit = document.getElementById('cancelEdit')

                    btnSave.style.display = 'none'
                    btnSaveEdit.style.display = 'block'
                    btnCancelEdit.style.display = 'block'

                    btnCancelEdit.addEventListener('click', cancelEdit)
                   
                }else{
                    alert(msg)
                }
            })
        });

    } catch (error) {
        console.log(error)
    }
}

const cancelEdit = () => {
    document.getElementById('formUser').reset()
    document.getElementById('provinceUser').value = 0
    document.getElementById('localitiesUser').innerHTML = ''
    document.getElementById('saveClient').style.display = 'block'
    document.getElementById('saveEdit').style.display = 'none'
    document.getElementById('cancelEdit').style.display = 'none'  
}


const saveEdit = () => {
    try {
        const btn = document.getElementById('saveEdit')
        btn.addEventListener('click', async e => {
            e.preventDefault()
            e.stopImmediatePropagation()
            const form = document.getElementById('formUser')
            const data = new FormData(form)
            let ok = true
            
            for (let d of data.entries()){
              if (!d[1] ) {
                document.getElementById('err-'+ d[0]).style.display = 'block' 
                ok = false
              }
            }
            if (ok) {
              const req = await fetch(`${API}/clients/setClient.php`,{
                method:'POST',
                body:data
              })
              let {msg} = await req.json()
              form.reset()
              alert(msg)
              getListClient()
              cancelEdit()
            }
        
        })
    } catch (error) {
        console.log(error)
    }
}