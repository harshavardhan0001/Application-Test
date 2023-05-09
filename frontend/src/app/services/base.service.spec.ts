import { TestBed } from '@angular/core/testing';

import { BaseService } from './base.service';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing';

describe('BaseService', () => {
  let url = 'http://localhost:4200/api';
  let httpController: HttpTestingController;
  let service: BaseService;
  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [ HttpClientTestingModule ]
    });
    service = TestBed.inject(BaseService);
    httpController = TestBed.inject(HttpTestingController);
    httpController = TestBed.inject(HttpTestingController);
  });

  it('should call getProducts and return an array of Products', () => {
    const products = {
      "status" : "success",
      "message" : "Products retrived successfully",
      "data" : []
    } ;
    service.getProducts().subscribe((res) => {
      expect(res).toEqual(products);
    });
    const req = httpController.expectOne({
      method: 'GET',
      url: `${url}/products`,
    });

    //4
    req.flush(products);

  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
