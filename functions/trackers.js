
// template = ["name",[["checkname",true]]];

const dflt = [
    ["To Do", true, "1", []], 
    ["In Progress", true, "100",[]], 
    ["Done", false, "final", []]
]

class Trackers {

    constructor(t, data) {

        try {
            this.trackers = t ? JSON.parse(t) : data ? JSON.parse(data) : dflt;
        } catch (e) {
            console.warn("Invalid localStorage data, resetting");
            this.trackers = dflt;
        }
    }

    save(name) {
        localStorage.setItem(name, JSON.stringify(this.trackers));

        const formData = new FormData();
        
        const ids = name.split("_");
        const data = JSON.stringify(this.trackers);

        formData.append("data", data);
        formData.append("id", ids[0])
        formData.append("site_id", ids[1])

        const func = "http://localhost/Development%20Progress%20Tracker/functions/saveData.php"

        fetch(func, {
            method: "POST",
            body: formData
        })

    }

    loadTrackerBase() {
        
        const newDiv = document.createElement("div");
        newDiv.style.columns = this.trackers.length+2;
        newDiv.id = "newDiv";

        const buttonDiv1 = document.createElement("div");
        buttonDiv1.className = "newTrackerButton";
        let button1 = document.createElement("button");
        button1.textContent = "+";
        button1.className = "newTracker";
        button1.setAttribute("onclick", "trackers.newTracker('left')");

        buttonDiv1.appendChild(button1);

        newDiv.appendChild(buttonDiv1);

        this.trackers.forEach((tracker, index) => {
            const trackerElement = this.renderTrackers(tracker, index);
            newDiv.appendChild(trackerElement);
        });

        const buttonDiv2 = document.createElement("div");
        buttonDiv2.className = "newTrackerButton";
        let button2 = document.createElement("button");
        button2.textContent = "+";
        button2.className = "newTracker";
        button2.setAttribute("onclick", "trackers.newTracker('right')");

        buttonDiv2.appendChild(button2);

        newDiv.appendChild(buttonDiv2);

        return newDiv;

    }

    renderTrackers(tracker, index) {

        const newDiv = document.createElement("div");
        newDiv.className = "track";
        newDiv.id = "track"+index;

        let deleteTrack = document.createElement("button");
        deleteTrack.textContent = "⌂";
        deleteTrack.className = "trackOptions";
        deleteTrack.setAttribute("onclick", "trackers.deleteTrack("+index+")");

        let renameTrack = document.createElement("button");
        renameTrack.textContent = "✎";
        renameTrack.className = "trackOptions";
        renameTrack.setAttribute("onclick", "trackers.renameTrack("+index+")");

        newDiv.appendChild(renameTrack);
        newDiv.appendChild(deleteTrack);

        const name = document.createElement("h2");
        const text = document.createTextNode(tracker[0]);
        name.appendChild(text);

        newDiv.appendChild(name);

        tracker[3].forEach((litem, lindex) => {

            const listElement = this.trackerList(litem, lindex, tracker[0]);
            newDiv.appendChild(listElement);

        });

        const button = document.createElement("button");
        button.textContent = "+";
        button.className = "newGoal";
        button.setAttribute("onclick", "trackers.newGoal('"+tracker[0]+"')");

        newDiv.appendChild(button);

        return newDiv;
    }

    trackerList(listItem, index, trackerName) {
        const newDiv = document.createElement("div");
        newDiv.className = "li";
        newDiv.id = "li"+index;

        let deleteList = document.createElement("button");
        deleteList.textContent = "⌂";
        deleteList.className = "listOptions";
        deleteList.setAttribute("onclick", "trackers.deleteList("+this.getTracker(trackerName)+","+index+")");

        let renameList = document.createElement("button");
        renameList.textContent = "✎";
        renameList.className = "listOptions";
        renameList.setAttribute("onclick", "trackers.renameList("+this.getTracker(trackerName)+","+index+")");

        let editChecks = document.createElement("button");
        editChecks.textContent = "✓";
        editChecks.className = "listOptions";
        editChecks.setAttribute("onclick", "trackers.editChecks("+this.getTracker(trackerName)+","+index+")");


        newDiv.appendChild(renameList);
        newDiv.appendChild(editChecks);
        newDiv.appendChild(deleteList);

        let listTotal = 0;
        let listValue = 0;

        const name = document.createElement("h3");
        const text = document.createTextNode(listItem[0]);
        name.appendChild(text);

        const lV = document.createElement("p");

        newDiv.appendChild(name);

        for (let i = 0; i < listItem[1].length; i++) {

            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = listItem[0]+"-"+listItem[1][i][0];
            checkbox.setAttribute("onclick", "trackers.check('"+trackerName+"',"+index+","+i+")");
            checkbox.checked = listItem[1][i][1];
            listTotal+=1;
            listValue+=(listItem[1][i][1])?1:0;

            newDiv.appendChild(checkbox);
            
            const label = document.createElement("label");
            const labelText = document.createTextNode(listItem[1][i][0]);
            label.appendChild(labelText);

            newDiv.appendChild(label);
            newDiv.appendChild(document.createElement("br"))

        }

        lV.textContent = (listTotal > 0)?(listValue/listTotal)*100+"%":"NaN";

        newDiv.insertBefore(lV,renameList);

        let Lbutton = document.createElement("button");
        Lbutton.textContent = "<";
        Lbutton.id = "left";
        Lbutton.setAttribute("onclick", "trackers.moveLeft('"+trackerName+"',"+index+")");

        let Rbutton = document.createElement("button");
        Rbutton.textContent = ">";
        Rbutton.id = "right";
        Rbutton.setAttribute("onclick", "trackers.moveRight('"+trackerName+"',"+index+")");

        newDiv.appendChild(Lbutton);
        newDiv.appendChild(Rbutton);

        return newDiv;

    }

    getTracker(trackerName) {
        let tracker = null;

        for (let i = 0; i < this.trackers.length; i++) {
            if (this.trackers[i][0] == trackerName) {tracker = i; break;}
        }

        return tracker;

    }

    newGoal(trackerName) {

        const trackerIndex = this.getTracker(trackerName);

        if (trackerIndex !== null) {
            const newGoal = ["", []];

            const goalName = prompt("Enter your new Goal:")

            if (goalName !== null) {
                let goalChecks = prompt("How many checks do you need?")

                newGoal[0] = goalName;

                if (goalChecks !== null) {
                    
                    if (!Number.isNaN(Number(goalChecks))) {
                        goalChecks = parseInt(goalChecks);
                    } else {goalChecks = 1;}

                    for (let i = 0; i < goalChecks; i++) {
                        let checkName = prompt("Check"+(i+1)+" name:");
                        checkName = (checkName!==null)?checkName:"";

                        newGoal[1].push([checkName, false]);
                    }
                }

                this.trackers[trackerIndex][3].push(newGoal);

                this.rerenderTrackers();

            }
        }
    }

    newTracker(t) {

        const newTracker = ["", false, null, []];

        const trackerName = prompt("New Tracker name:");

        if (trackerName != null) {

            const trackerIncrement = prompt("What percentage (%) of goal completion increments it to another Tracker? | click Cancel to disable auto-increment");

            newTracker[0] = trackerName;

            if (trackerIncrement != null && !Number.isNaN(Number(trackerIncrement))) {
                
                newTracker[1] = true;
                newTracker[2] = trackerIncrement;

            }

            if (t == "left") {
                this.trackers.unshift(newTracker);
            } else {
                this.trackers.push(newTracker);
            }

            this.rerenderTrackers();

        }

    }

    moveLeft(trackerName,listIndex) {

        const trackerIndex = this.getTracker(trackerName);

        if (trackerIndex > 0) {
            let temp = this.trackers[trackerIndex][3][listIndex];
            this.trackers[trackerIndex][3].splice(listIndex,listIndex+1);
            this.trackers[trackerIndex-1][3].push(temp);

            this.rerenderTrackers();

        }

    }

    moveRight(trackerName,listIndex) {

        const trackerIndex = this.getTracker(trackerName);

        if (trackerIndex < this.trackers.length) {
            let temp = this.trackers[trackerIndex][3][listIndex];
            console.log(this.trackers[trackerIndex][3].splice(listIndex,listIndex+1));
            this.trackers[trackerIndex+1][3].push(temp);

            this.rerenderTrackers();

        }

    }

    check(trackerName,listIndex,checkIndex) {

        const trackerIndex = this.getTracker(trackerName);

        this.trackers[trackerIndex][3][listIndex][1][checkIndex][1] = !this.trackers[trackerIndex][3][listIndex][1][checkIndex][1];

        this.rerenderTrackers();

    }

    rerenderTrackers() {

        const del = document.getElementById("newDiv");
        del.remove();

        let path = window.location.pathname;
        let filename = path.substring(path.lastIndexOf("/") + 1);
        filename = filename.substring(0, filename.length-4);

        this.save(filename);

        document.getElementById("container").appendChild(this.loadTrackerBase());

    }

    deleteTrack(index) {
        let sure = prompt("Are you sure you want to delete "+this.trackers[index][0]+"?");

        if(sure !== null) {
            this.trackers.splice(index,index+1);
        }

        this.rerenderTrackers()
    }

    renameTrack(index) {
        let rename = prompt("Do you want to rename "+this.trackers[index][0]+"?");

        if(rename !== null) {
            this.trackers[index][0] = rename;
        }

        this.rerenderTrackers()
    }

    deleteList(Trackerindex, index) {
        let sure = prompt("Are you sure you want to delete "+this.trackers[Trackerindex][3][index][0]+"?");

        if(sure !== null) {
            this.trackers[Trackerindex][3].splice(index,index+1);
        }

        this.rerenderTrackers()
    }

    renameList(Trackerindex, index) {
        let rename = prompt("Do you want to rename "+this.trackers[Trackerindex][3][index][0]+"?");

        if(rename !== null) {
            this.trackers[Trackerindex][3][index][0] = rename;
        }

        this.rerenderTrackers()
    }

    editChecks(Trackerindex, index) {

        let goalChecks = prompt("How many checks do you need to add or delete?")

        if (goalChecks !== null) {
                    
            if (!Number.isNaN(Number(goalChecks))) {

                goalChecks = parseInt(goalChecks);

            } else {goalChecks = 1;}
            
            if (goalChecks < 0) {

                if (this.trackers[Trackerindex][3][index][1].length+goalChecks <= 0 ) {
                    let confirm = prompt("Are you sure you want to delete all checks?");
                    if (confirm !== null) {
                        this.trackers[Trackerindex][3][index][1].splice(0,this.trackers[Trackerindex][3][index][1].length+1)
                    }
                } else {
                    let confirm = prompt("Are you sure you want to delete "+(goalChecks*(-1))+" checks?");
                    if (confirm !== null) {
                        this.trackers[Trackerindex][3][index][1].splice(this.trackers[Trackerindex][3][index][1].length+goalChecks,  this.trackers[Trackerindex][3][index][1].length+1)
                    }
                }

            } else {
                for (let i = 0; i < goalChecks; i++) {
                    let checkName = prompt("Check"+(i+1)+" name:");
                    checkName = (checkName!==null)?checkName:"";

                    this.trackers[Trackerindex][3][index][1].push([checkName, false]);
                }
            }
        }

        this.rerenderTrackers();

    }

}

function removeSave(name) {

    localStorage.removeItem(name);

}