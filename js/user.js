let user = ()=>{

    this.data = {
        fn : null
        ,ln : null
        ,email : null
        ,session : null
    };

    this.loadup = (info)=> {
        for (let i in data){
            this.data[i] = (info[i] !== undefined)? info[i] : null;
        }
    };

    this.getInfo = ()=>{
        return this.data;
    }

};