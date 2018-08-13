function load() {
    ambil("./load", (res) => {
        tulis("#load", res)
    })
}
function del(val) {
    pos("./delete", "iduser="+val, () => {
        load()
    })
}
klik("#new", () => {
    munculPopup("#bagAdd", pengaya("#bagAdd", "top: 80px"))
})

tekan("Escape", () => {
    hilangPopup("#bagAdd")
    hilangPopup("#successAdd")
})

submit("#formAdd", () => {
    let name = pilih("#name").value
    let address = pilih("#address").value
    let addParam = "name="+name+"&address="+address
    pos("./add", addParam, () => {
        hilangPopup("#bagAdd")
        munculPopup("#successAdd", pengaya("#successAdd", "top: 130px"))
        setTimeout(() => {
            hilangPopup("#successAdd")
            load()
        })
    })
    return false
})

klik("#xAdd", () => {
    hilangPopup("#bagAdd")
})
klik("#xSuccess", () => {
    hilangPopup("#successAdd")
})

load()