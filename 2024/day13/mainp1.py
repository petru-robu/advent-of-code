f = open('2.in', 'r')

def nmbs(s):
    numbers = []
    current_number = ""

    for char in s:
        if char.isdigit():
            current_number += char
        elif current_number:
            numbers.append(int(current_number))
            current_number = ""
            if len(numbers) == 2:
                break

    if current_number and len(numbers) < 2:
        numbers.append(int(current_number))

    return numbers


def solve(xa, ya, xb, yb, targetX, targetY):
    minCost = 1000001

    for cntA in range(0, 101):
        for cntB in range(0, 101):
            if targetX == cntA*xa + cntB*xb and targetY == cntA*ya + cntB*yb:
                cost = cntA*3 + cntB
                minCost = min(cost, minCost)

    return minCost

if __name__ == '__main__':
    lines = f.readlines()

    ans = 0

    for i in range(0, len(lines), 4):
        xa, ya = nmbs(lines[i])
        xb, yb = nmbs(lines[i+1])
        targetX, targetY = nmbs(lines[i+2])

        s = solve(xa, ya, xb, yb, targetX, targetY)

        if s != 1000001:
            ans += s 

    print(ans)