import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { catchError, delay, map, take } from 'rxjs/operators';
import { Product } from '../../product/product';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../../environments/environment'
import { IHttpResponse } from '../../http-response/http-response';
import { Image } from '../../image/image';

@Injectable({
    providedIn: 'root'
})

export class ProductService {


    constructor(private http: HttpClient) { }

  :   getProduct(id: string): Observable<Product | any> {
    return this.http.get<IHttpResponse>(environment.apiUrl + 'products/' + id).pipe(
        map((response) => response.data),
        catchError(this.handleError<Product>('getProduct'))
    );
}

// Manejo de errores
private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
        console.error(`${operation} failed: ${error.message}`);
        return of(result as T);
    };
}

    //buscador de productos 
    searchProducts(term: string): Observable<Product[]> {

        return this.http.get<IHttpResponse>(environment.apiUrl + 'products?search=' + term).pipe(
            map((response) => response.data),
            catchError(this.handleErrorShearch<Product[]>('searchProducts', [])),
        );
    }
    // Manejo de errores
    private handleErrorShearch<T>(operation = 'operation', result?: T) {
        return (error: any): Observable<T> => {
            console.error(`${operation} failed: ${error.message}`);
            return of(result as T);
        };
    }


    // busco el producto según el id recibido
    getProductWithCustomerDiscount(term: string, customerId: string): Observable<Product | any> {
      
        return this.http.get<IHttpResponse>(environment.apiUrl + 'products?search=' + term + '&customer=' + customerId).pipe(
            map((response) => {
              //  console.log('getProductWithCustomerDiscount: ', response.data);
                return response.data;
            }),
            catchError(this.handleErrorgetProductWithCustomerDiscount<Product>('getProductWithCustomerDiscount'))
        );
    }

    // Manejo de errores
    private handleErrorgetProductWithCustomerDiscount<T>(operation = 'operation', result?: T) {
        return (error: any): Observable<T> => {
            console.error(`${operation} failed: ${error.message}`);
            return of(result as T);
        };
    }



    // buscado de imagenes para el pipe
    getPreferredImage(images: Image[]): Image | undefined {
        return images.find(image => image.preferred);
    }



    downLoadPDFService(productId: number, fileId: number): Observable<string> {
        const url = `${environment.apiUrl}products/${productId}/files/${fileId}`;
        
        return this.http.get(url, { responseType: 'blob' }).pipe(
            map((response: Blob) => {
                console.log('PDF Blob en el SERVICIO:', response);
                const downloadUrl = URL.createObjectURL(response);
                console.log('PDF Download URL:', downloadUrl);
                return downloadUrl;
            }),
            catchError(this.handleErrorPDF<string>('downLoadPDF', '')));
    }

    // Método para manejar errores
    private handleErrorPDF<T>(operation = 'operation', result?: T) {
        return (error: any): Observable<T> => {
            console.error(`${operation} failed: ${error.message}`);
            return of(result as T);
        };
    }


}