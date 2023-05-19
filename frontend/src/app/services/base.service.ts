

import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Iresponse } from '../models/iresponse';
import { Iproduct } from '../models/iproduct';
import { Observable, catchError, throwError } from 'rxjs';
// import { catchError, retry } from 'rxjs/operators'
// import { throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class BaseService {
    apiUrl = "http://localhost:4200/api/";
    constructor(private http: HttpClient){}

    getProducts() {
        return this.http.get<Iresponse>(this.apiUrl+"products").pipe(
            catchError(err => this.handleError(err))
        );
    }
    updateProducts(data: Iproduct) {
        return this.http.post<Iresponse>(this.apiUrl+"products/update",data).pipe(
            catchError(err => this.handleError(err))
        );
    }
    deleteProducts(data: Iproduct) {
        return this.http.put<Iresponse>(this.apiUrl+"products/delete",data).pipe(
            catchError(err => this.handleError(err))
        );
    }
    addProducts(data: any) {
        return this.http.post<Iresponse>(this.apiUrl+"products/add",data).pipe(
            catchError(err => this.handleError(err))
        );
    }

    handleError(error: HttpErrorResponse){
        if (error.status === 0) {
            // A client-side or network error occurred. Handle it accordingly.
            console.error('An error occurred:', error.error);
          } else {
            // The backend returned an unsuccessful response code.
            // The response body may contain clues as to what went wrong.
            console.error(
              `Backend returned code ${error.status}, body was: `, error.error);
          }
          // Return an observable with a user-facing error message.
          return throwError(() => new Error('Something bad happened; please try again later.'));
    }
}