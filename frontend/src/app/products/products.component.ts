import { Component } from '@angular/core';
import { ColDef } from 'ag-grid-community';
import { BaseService } from '../services/base.service';
import { Inotify, Iproduct } from './models/iproduct';
import { ActionCellRenderer } from './actionCell.component';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})

export class ProductsComponent {
  // To toggle nofication message
  public notifyPop: boolean = false;
  // Api Response status message
  public notifyMsg: Inotify = {success:false,msg:""};
  // Holds all products data
  rowData: any = [];

  // To define column definations
  columnDefs: ColDef[] = [
    {field:'id', width: 50},
    {field:'name'},
    {field:'state', width: 100},
    {field:'zip', width:100},
    {editable: true, field:'amount', width:100},
    {editable: true, field:'quantity', width:100},
    {field:'item', width:100},
    {
      headerName: "Action",
      minWidth: 150,
      cellRenderer: ActionCellRenderer,
      editable: false,
      colId: "action"
    }
  ];
  
  // To define default column definations which is applicable for all columns
  defaultColDef = {
    sortable: true
  };

  constructor(
    private baseService: BaseService) {
  }
  
/**
 * Retrives data from add product components.
 * Send new product data to service to create
 * @param {Iproduct} event The event must be new product data.
 */
  createProduct($event:Iproduct){
    this.baseService.addProducts($event).subscribe(() => {
      this.baseService.getProducts().subscribe((resp) => {
        this.rowData = resp.data;
      });
    });
  }

/**
 * On grid ready loads product list.
 * @param {any} params The params is ag-grid api event data.
 */
  onGridReady(params:any) {
    this.baseService.getProducts().subscribe((resp) => {
      this.rowData = resp.data;
    });
  }

/**
 * To handle each action button click.
 * @param {any} params The params is ag-grid api event data.
 */
  onCellClicked(params:any) {
    if (params.column.colId === "action" && params.event.target.dataset.action) {
      let action = params.event.target.dataset.action;
      
      if (action === "edit") {
        params.api.startEditingCell({
          rowIndex: params.node.rowIndex,
          colKey: params.columnApi.getDisplayedCenterColumns()[0].colId
        });
      }

      if (action === "delete") {
        params.api.applyTransaction({
          remove: [params.node.data]
        });
        this.baseService.deleteProducts(params.node.data).subscribe((resp) => {
           resp.status != "error" ? this.showNotifyPop({success:true,msg:resp.message}) : this.showNotifyPop({success:false,msg:resp.message}) 
        });
      }

      if (action === "update") {
        params.api.stopEditing(false);
        this.baseService.updateProducts(params.node.data).subscribe((resp) => {
          resp.status != "error" ? this.showNotifyPop({success:true,msg:resp.message}) : this.showNotifyPop({success:false,msg:resp.message}) 
        });

      }

      if (action === "cancel") {
        params.api.stopEditing(true);
      }
    }
  }

/**
 * To track row changes for updating product.
 * @param {any} params The params is ag-grid api event data.
 */
  onRowEditingStarted(params:any) {
    params.api.refreshCells({
      columns: ["action"],
      rowNodes: [params.node],
      force: true
    });
  }

/**
 * Handles when row editing stops.
 * @param {any} params The params is ag-grid api event data.
 */
  onRowEditingStopped(params:any) {
    params.api.refreshCells({
      columns: ["action"],
      rowNodes: [params.node],
      force: true
    });
  }

/**
 * Hanles alerts and Notifications.
 * @param {Inotify} msg The params is ag-grid api event data.
 * @returns void
 */
  showNotifyPop(msg:Inotify) : void {
    this.notifyMsg = msg;
    if (this.notifyPop) { 
      return;
    } 
    this.notifyPop = true;
    setTimeout(()=> this.notifyPop = false,2500)
  }
}
