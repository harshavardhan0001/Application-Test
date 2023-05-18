

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Iresponse } from '../models/iresponse';
import { Iproduct } from '../products/models/iproduct';
// import { catchError, retry } from 'rxjs/operators'
// import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class BaseService {
    apiUrl = "http://localhost:4200/api/";
    constructor(private http: HttpClient){}

    getProducts() {
        return this.http.get<Iresponse>(this.apiUrl+"products");
    }
    updateProducts(data: Iproduct) {
        return this.http.post<Iresponse>(this.apiUrl+"products/update",data);
    }
    deleteProducts(data: Iproduct) {
        return this.http.put<Iresponse>(this.apiUrl+"products/delete",data);
    }
    addProducts(data: any) {
        return this.http.post<Iresponse>(this.apiUrl+"products/add",data);
    }
}