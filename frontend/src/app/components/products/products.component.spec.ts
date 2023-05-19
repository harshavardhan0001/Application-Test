import { HttpClientTestingModule,HttpTestingController } from '@angular/common/http/testing';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { FormBuilder, FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AgGridModule } from 'ag-grid-angular';
import { BaseService } from '../../services/base.service';
import { AddProductComponent } from './add-product/add-product.component';
import { ProductsComponent } from './products.component';

describe('ProductsComponent', () => {
  let component: ProductsComponent;
  let fixture: ComponentFixture<ProductsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule,
        AgGridModule,
        ReactiveFormsModule
      ], 
      declarations: [ ProductsComponent,AddProductComponent ],
      providers: [
        BaseService
      ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ProductsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });


  it('the grid cells should be as expected', () => {
    const appElement = fixture.nativeElement;
    const cellElements = appElement.querySelectorAll('.ag-header-cell ');

    expect(cellElements.length).toEqual(8);
    expect(cellElements[0].textContent).toContain("Id");
    expect(cellElements[1].textContent).toContain("Name");
    expect(cellElements[2].textContent).toContain("State");
});
});
