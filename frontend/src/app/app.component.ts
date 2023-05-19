import { Component } from '@angular/core';
import { NotifyService } from './services/notify.service';
import { Inotify } from './models/iproduct';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'frontend';
  // Tells whether to show alert message when true and hides when false
  public notifyPop: boolean = false;
  // Api Response status message
  public notifyMsg: Inotify = {success:false,msg:""};

  constructor(private notifyService: NotifyService) {

  }
  ngOnInit() {
    // To observe new notification and shows alert message
    this.notifyService.getNewNotification.subscribe((response: Inotify)  => {
        this.notifyMsg = response;
        if (response.msg == '') {return;} 
        this.notifyPop = true;
        setTimeout(()=> this.notifyPop = false,10000)
    })
  }

  // To close the alert message
  dismissNotify() {
    this.notifyPop = false;
  }
}
